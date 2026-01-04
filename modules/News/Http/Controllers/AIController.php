<?php

namespace Modules\News\Http\Controllers;

use App\Models\AISettings;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('news::ai.ai_settings');
    }

    public function index()
    {
        $settings = AISettings::firstOrCreate([]);
        return view('news::ai.ai_settings', compact(var_name: 'settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'api_key' => 'required',
            'model' => 'required',
            'temperature' => 'required|numeric',
            'max_tokens' => 'required|integer',
        ]);

        // dd($request->all());

        $settings = AISettings::firstOrCreate([]);
        $settings->update([
            'api_key' => $request->api_key,
            'model' => $request->model,
            'temperature' => $request->temperature,
            'max_tokens' => $request->max_tokens,
            'prompt_template' => $request->prompt_template,
        ]);

        return redirect()->back()->with('success', 'AI Settings Updated Successfully');
    }


    public function generateText(Request $request)
    {

        $request->validate([
            'prompt' => 'required|string',
        ]);

        $settings = AISettings::first();

        if (!$settings) {
            return response()->json(['error' => 'AI Settings not configured.'], 422);
        }

        try {
            // Call OpenAI (example using HTTP facade, adjust for your actual call)
            $response = Http::withToken($settings->api_key)->post('https://api.openai.com/v1/chat/completions', [
                'model' => $settings->model,
                'messages' => [
                    ['role' => 'system', 'content' => $settings->prompt_template ?? 'You are a helpful assistant.'],
                    ['role' => 'user', 'content' => $request->prompt],
                ],
                'max_tokens' => $settings->max_tokens,
                'temperature' => $settings->temperature,
            ]);

            $result = $response->json();
            
        // dd($result);

            $text = $result['choices'][0]['message']['content'] ?? 'No response.';

            return response()->json(['text' => $text]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('news::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('news::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
