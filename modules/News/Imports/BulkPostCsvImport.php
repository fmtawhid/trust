<?php

namespace Modules\News\Imports;


use Carbon\Carbon;
use App\Models\NewsMst;
use App\Models\PostTag;
use App\Models\SchemaPost;
use App\Models\BreakingNews;
use App\Services\XmlService;
use App\Models\PostSeoOnpage;
use App\Models\NewsPositionMap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Modules\Category\Entities\Category;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class BulkPostCsvImport implements ToModel, WithChunkReading, WithHeadingRow
{
    public static array $skippedRows = [];

    public function model(array $row)
    {
        $row = array_map(function ($value) {
            return trim($value) === '' ? null : trim($value);
        }, $row);
        
        $auth_user = auth()->user();

        $languageId = $row['language_id'] ?? null;
        $categoryId = $row['category_id'] ?? null;
        $subCategoryId = $row['sub_category_id'] ?? null;
        $categoryPosition = $row['category_position'] ?? null;
        $homePosition = $row['home_position'] ?? null;
        $publishDate = $row['publish_date'] ?? null;
        $shortHead = $row['short_head'] ?? null;
        $headLine = $row['head_line'] ?? null;
        $detailsPost = $row['details_post'] ?? null;
        $image = $row['image'] ?? null;
        $imageAlt = $row['image_alt'] ?? null;
        $imageTitle = $row['image_title'] ?? null;
        $customUrl = $row['custom_url'] ?? null;
        $seoTitle = $row['seo_title'] ?? null;
        $reporterId = $row['reporter_id'] ?? $auth_user->reporter->id ?? null;
        $reporterMessage = $row['reporter_message'] ?? null;
        $videoUrl = $row['video_url'] ?? null;
        $reference = $row['reference'] ?? null;
        $postTag = $row['post_tag'] ?? null;
        $metaKeyword = $row['meta_keyword'] ?? null;
        $metaDescription = $row['meta_description'] ?? null;
        $latestPost = $row['latest_post'] ?? null;
        $breakingPost = $row['breaking_post'] ?? null;
        $featurePost = $row['feature_post'] ?? 0;
        $recommandedPost = $row['recommanded_post'] ?? 0;
        $status = $row['status'] ?? 0;
        $schemaSetup = $row['schema_setup'] ?? 0;

        // Skip this row if any required field is missing
        if (!$languageId || !$categoryId || !$publishDate || !$headLine || !$detailsPost || !$reporterId) {
            self::$skippedRows[] = $row;

            if (!$languageId)   $missingFields[] = 'languageId';
            if (!$categoryId)   $missingFields[] = 'categoryId';
            if (!$publishDate)  $missingFields[] = 'publishDate';
            if (!$headLine)     $missingFields[] = 'headLine';
            if (!$detailsPost)  $missingFields[] = 'detailsPost';
            if (!$reporterId)   $missingFields[] = 'reporterId';

            Log::warning('Row skipped due to missing fields', [
                'missing_fields' => $missingFields,
            ]);

            return null;
        }

        try {
            DB::beginTransaction();

            $post_ap_status = 0;

            if ($auth_user->post_ap_status != 0) {
                $post_ap_status = 1;
            } else {
                $post_ap_status = $status;
            }

            if ($post_ap_status == 1) {
                $sta = 0;
            } else {
                $sta = 1;
            }

            $generate_id = NewsMst::max('id') + 1;
            $other_page  = $categoryId;
            $title       = $headLine;
            $categoryData = Category::where('id', $other_page)->first();

            $rawTitle = $customUrl ? $customUrl : $headLine;
            $encode_title = generateSlug($rawTitle);

            $page                   = $categoryData->slug ?? 'home';
            $post_by                = auth()->user()->id ?? null;
            $publish_date           = $publishDate;
            $other_position         = $categoryPosition ?? 1;
            $breaking_confirmed     = $breakingPost ?? null;
            $time_stamp             = time();

            $newsMstData = [
                'news_id'          => $generate_id,
                'language_id'      => $languageId,
                'category_id'      => $other_page ?? null,
                'sub_category_id'  => $subCategoryId ?? null,
                'encode_title'     => strtolower($encode_title),
                'seo_title'        => $seoTitle ?? null,
                'stitle'           => $shortHead ?? null,
                'title'            => $title,

                'news'             => $detailsPost,
                'image'            => $image,
                'image_base_url'   => null,
                'image_alt'        => $imageAlt,
                'image_title'      => $imageTitle,

                'videos'           => $videoUrl,
                'podcust_id'       => null,
                'page'             => $page,
                'reference'        => $reference,
                'reporter_id'      => $reporterId,

                'reporter'         => null,
                'reporter_message' => $reporterMessage,
                'post_by'          => $post_by,
                'update_by'        => null,
                'time_stamp'       => $time_stamp,
                'post_date'        => Carbon::now(),
                'publish_date'     => $publish_date,
                'last_update'      => Carbon::now()->format('Y-m-d h:i:s'),
                'reader_hit'       => 0,
                'is_latest'        => $latestPost,
                'is_featured'      => $featurePost,
                'is_recommanded'   => $recommandedPost,
                'status'           => $sta,
            ];

            $newsMst = NewsMst::create($newsMstData);

            // Create the position map
            $newsPositionMapData = [
                'news_id'             => $newsMst->id,
                'home_position'       => $homePosition,
                'category_id'         => $other_page,
                'category_position'   => $other_position,
                'sub_category_id'     => $subCategoryId,
                'sub_category_position' => null,
                'status'              => 1,
            ];

            NewsPositionMap::create($newsPositionMapData);


            /**
             * create breaking news
             */

            if ($breaking_confirmed && $breaking_confirmed == 1) {

                $br_data                   = [];
                $br_data['news_title']     = $title;
                $br_data['url']            = strtolower($encode_title);
                $JSON_format_breaking_news = json_encode($br_data);

                $breakingNewsData = [
                    'language_id'=> $languageId,
                    'news_id'    => $newsMst->id,
                    'title'      => $JSON_format_breaking_news,
                    'time_stamp' => $time_stamp,
                    'status'     => 1,
                ];

                BreakingNews::create($breakingNewsData);
            }

            XmlService::rss_xml();
            XmlService::sitemap_xml();

            if (!empty($metaKeyword) && !empty($metaDescription)) {
                $post_meta                     = [];
                $post_meta['meta_keyword']     = $metaKeyword;
                $post_meta['meta_description'] = $metaDescription;
                $post_meta['news_id']          = $newsMst['news_id'];
                
                PostSeoOnpage::create($post_meta);
            }

            if (!empty($postTag)) {

                $post_tag = explode(',', $postTag);

                foreach ($post_tag as $key => $tags) {
                    $t   = $this->explodedTitle($tags);
                    $tag = [
                        'news_id' => $newsMst['news_id'],
                        'tag'     => $t,
                    ];
                    PostTag::create($tag);
                }

            }

            if (!empty($schemaSetup)) {
                $schemapost                   = [];
                $schemapost['type']           = 'Article';
                $schemapost['url']            = null;
                $schemapost['headline']       = $headLine;
                $schemapost['image_url']      = null;
                $schemapost['description']    = implode(' ', array_slice(explode(' ', $detailsPost), 0, 60));
                $schemapost['author_type']    = 'person';
                $schemapost['author_name']    = null;
                $schemapost['publisher']      = null;
                $schemapost['publisher_logo'] = null;
                $schemapost['publishdate']    = $publishDate;
                $schemapost['modifidate']     = $publishDate;
                $schemapost['news_id']        = $newsMst['news_id'];

                SchemaPost::create($schemapost);
            }

            DB::commit();

            return $newsMst;

        } catch (\Exception $e) {
            DB::rollBack();
            self::$skippedRows[] = array_merge($row, ['error' => $e->getMessage()]);
             Log::error('Something went wrong: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            return null;
        }
    }

    public function chunkSize(): int
    {
        return 5;
    }

    private function explodedTitle(string $title)
    {
        $string  = str_replace(' ', '-', trim($title));
        return $string;
    }
}
