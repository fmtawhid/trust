<?php

namespace Modules\Story\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Modules\Story\Entities\Story;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Localize\Entities\Language;
use Illuminate\Contracts\Support\Renderable;
use Modules\Story\DataTables\StoriesDataTable;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(StoriesDataTable $dataTable)
    {
        $languages = Language::all();

        return $dataTable->render('story::index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('story::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'language_id' => 'required|exists:languages,id',
                'stories' => 'required|array|min:1',
                'stories.*.title' => 'required|string|max:255',
                'stories.*.text' => 'nullable|string|max:255',
                'stories.*.link' => 'nullable|string|max:255',
                'stories.*.image_base64' => 'required|string',
            ]);
    
            $mainTitle = $validated['stories'][0]['title'];
    
            $mainStory = Story::create([
                'language_id' => $request->language_id,
                'title' => $mainTitle,
                'slug' => generateSlug($mainTitle),
                'created_by' => auth()->id(),
            ]);
    
            foreach ($validated['stories'] as $storyData) {
                $imagePath = null;
    
                if (!empty($storyData['image_base64'])) {
                    $imagePath = $this->saveBase64Image($storyData['image_base64']);
                }
    
                $mainStory->details()->create([
                    'title' => $storyData['title'],
                    'image_path' => $imagePath,
                    'button_text' => $storyData['text'] ?? null,
                    'button_link' => $storyData['link'] ?? null,
                ]);
            }
    
            return redirect()->back()->with('success', 'Stories saved successfully!');

        } catch (\Throwable $th) {
            return redirect()->back()->with('fail', $th->getMessage());
        }
    }

    private function saveBase64Image($base64Image)
    {
        preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type);

        $data = substr($base64Image, strpos($base64Image, ',') + 1);
        $type = strtolower($type[1]);

        $data = base64_decode($data);

        if ($data === false) {
            throw new \Exception('Base64 decode failed');
        }

        $fileName = uniqid() . '.' . $type;
        $filePath = 'story_images/' . $fileName;

        Storage::disk('public')->put($filePath, $data);

        return $filePath;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id): JsonResponse
    {
        try {
            $storyData = Story::with('details')->find($id);
            if (!$storyData) {
                throw new \Exception('Story not found');
            }

            return response()->json($storyData, 200);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        try {

            $storyData = Story::with('details')->find($id);
            if (!$storyData) {
                throw new \Exception('Story not found');
            }
            $languages = Language::all();

            return view('story::edit', compact('storyData', 'languages'));

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'language_id' => 'required|exists:languages,id',
                'deleteStory' => 'array',
                'stories' => 'array|min:1',
                'stories.*.title' => 'string|max:255',
                'stories.*.text' => 'nullable|string|max:255',
                'stories.*.link' => 'nullable|string|max:255',
                'stories.*.image_base64' => 'string',
            ]);
    
            $storyData = Story::with('details')->find($id);
            if (!$storyData) {
                throw new \Exception('Story not found');
            }

            // Delete story details by IDs using the relationship
            if (!empty($validated['deleteStory'])) {
                $storyData->details()->whereIn('id', $validated['deleteStory'])->delete();
            }
    
            if (isset($validated['stories']) && count($validated['stories']) > 0) {
                // Use a different variable name inside the foreach loop
                foreach ($validated['stories'] as $storyDetail) { // Renamed to $storyDetail
                    $imagePath = null;
        
                    if (!empty($storyDetail['image_base64'])) {
                        $imagePath = $this->saveBase64Image($storyDetail['image_base64']);
                    }
        
                    $storyData->details()->create([ // Use $storyData here, which is the Story model instance
                        'title' => $storyDetail['title'],
                        'image_path' => $imagePath,
                        'button_text' => $storyDetail['text'] ?? null,
                        'button_link' => $storyDetail['link'] ?? null,
                    ]);
                }
            }

            // Get the first detail in ascending order
            $firstDetail = $storyData->details()->orderBy('id', 'asc')->first();
            if ($firstDetail) {
                $mainTitle = $firstDetail->title;

                // Update the main story title
                $storyData->update([
                    'language_id' => $request->language_id,
                    'title' => $mainTitle,
                    'slug' => generateSlug($mainTitle),
                    'updated_by' => auth()->id(),
                ]);
            } else {
                Story::where('id', $id)->delete();
            }
    
            return redirect()->back()->with('success', 'Stories updated successfully!');

        } catch (\Throwable $th) {
            return redirect()->back()->with('fail', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, int $id)
    {
        try {
            // Find the story by ID
            $story = Story::findOrFail($id);

            // Delete related story_details (assuming a relationship exists)
            $story->details()->delete();

            // Delete the story
            $story->delete();

            return response()->json([
                'success' => true,
                'message' => 'Story have been deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
