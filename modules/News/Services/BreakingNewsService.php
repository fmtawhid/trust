<?php

namespace Modules\News\Services;

use Exception;
use App\Models\BreakingNews;
use App\Models\NewsPosition;
use Illuminate\Support\Facades\DB;
use Modules\Category\Entities\Category;
use Modules\Localize\Entities\Language;
use Illuminate\Http\Exceptions\HttpResponseException;

class BreakingNewsService
{
    /**
     * Form Data
     *
     * @param  array  $attributes
     * @return array
     */
    public function formData(): array
    {
        $categories    = Category::get();
        $newsPositions = NewsPosition::with('newsMst')->get();
        $languages = Language::all();

        return compact('categories', 'newsPositions', 'languages');
    }

    /**
     * Create
     *
     * @param  array  $attributes
     * @return BreakingNews
     * @throws Exception
     */
    public function create(array $attributes): BreakingNews
    {
        $breaking_news = $attributes['breaking_news'];

        try {
            DB::beginTransaction();

            $data = [
                'language_id'=> $attributes['language_id'],
                'title'      => json_encode(['news_title' => $breaking_news, 'url' => '']),
                'time_stamp' => time(),
                'status'     => 1,
            ];

            $breakingNews = BreakingNews::create($data);

            DB::commit();

            return $breakingNews;
        } catch (Exception $exception) {

            DB::rollBack();

            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => localize("breaking_news_create_error"),
                'title'   => localize("breaking_news"),
            ], 422));
        }

    }

    /**
     * Create
     *
     * @param  array  $attributes
     * @return BreakingNews
     * @throws Exception
     */
    public function edit(array $attributes): BreakingNews
    {
        $breakingNewsId = $attributes['id'];

        $breakingNews = BreakingNews::find($breakingNewsId);

        if (!$breakingNews) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => localize("breaking_news_data_find_error"),
                'title'   => localize("breaking_news"),
            ], 422));
        }

        return $breakingNews;
    }

    /**
     * Update
     *
     * @param  array  $attributes
     * @return bool
     * @throws Exception
     */
    public function update(array $attributes): bool
    {
        $breakingNewsId = $attributes['id'];
        $breaking_news  = $attributes['breaking_news'];

        try {
            DB::beginTransaction();
            $data = [
                'language_id'=> $attributes['language_id'],
                'title' => json_encode(['news_title' => $breaking_news, 'url' => '']),
            ];

            BreakingNews::where('id', $breakingNewsId)->update($data);

            DB::commit();

            return true;
        } catch (Exception $exception) {

            DB::rollBack();

            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => localize("breaking_news_update_error"),
                'title'   => localize("breaking_news"),
            ], 422));
        }

    }

    /**
     * Delete
     *
     * @param  array  $attributes
     * @return bool
     * @throws Exception
     */
    public function destroy(array $attributes): bool
    {
        $breakingNewsId = $attributes['id'];

        try {
            DB::beginTransaction();

            BreakingNews::where('id', $breakingNewsId)->delete();

            DB::commit();

            return true;

        } catch (Exception $exception) {
            DB::rollBack();

            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => localize("breaking_news_delete_error"),
                'title'   => localize("breaking_news"),
            ], 422));
        }

    }

}
