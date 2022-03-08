<?php

namespace App\Imports;

use App\Models\Article;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ArticleImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // return new Article([
        //     'season' => $row['Season'],
        //     'dumy_code' => $row['Dumy Code'],
        //     'final_code' => $row['Final Code'],
        //     'style' => $row['Style'],
        //     'source' => $row['Source'],
        //     'style_desc' => $row['StyleDesc'],
        //     'color_desc' => $row['Color Desc'],
        //     'page_RBU' => $row['Page RBU'],
        //     'display_BU' => $row['Display BU'],
        //     'age_group' => $row['Age Group'],
        //     'key' => $row['Key'],
        //     'sort_key' => $row['Sort Key'],
        //     'product_type' => $row['Product Type'],
        //     'final_MRP' => $row['Final MRP'],
        //     'final_gender' => $row['Final Gender'],
        //     'global_ki' => $row['Global KI'],
        //     'marketing_tier' => $row['Marketing Tier'],
        //     'channel-w22' => $row['Channel-aw22'],
        //     'line' => $row['Line'],
        //     'customer(online)' => $row['Cutomer (Online)'],
        //     'story' => $row['Story'],
        //     'colab' => $row['Colab'],
        //     'upper' => $row['Upper'],
        //     'mid_sole' => $row['Mid Sole'],
        //     'out_sole' => $row['Out Sole'],
        //     'description' => $row['Description'],
        //     'size_run' => $row['Size Run'],
        //     'technology' => $row['TECHNOLOGY'],
        //     'marketing' => $row['MARKETING'],
        //     'additional' => $row['ADDITIONAL'],
        //     'key_highlight' => $row['KEY HIGHLIGHT'],
        //     'fk_retail' => $row['FK Retail'],
        //     'fk_discount' => $row['FK Discount'],
        //     'myntra_retail' => $row['Myntra Retail'],
        //     'myntra_discount' => $row['Myntra Discount'],
        //     'ajio_retail' => $row['AJIO Retail'],
        //     'ajio_discount' => $row['AJIO Discount'],
        //     'amazon_discount' => $row['Amazon Discount'],
        // ]);


        $model = Article::create([
            'season' => $row['Season'],
            'dumy_code' => $row['Dumy Code'],
            'final_code' => $row['Final Code'],
            'style' => $row['Style'],
            'source' => $row['Source'],
            'style_desc' => $row['StyleDesc'],
            'color_desc' => $row['Color Desc'],
            'page_RBU' => $row['Page RBU'],
            'display_BU' => $row['Display BU'],
            'age_group' => $row['Age Group'],
            'key' => $row['Key'],
            'sort_key' => $row['Sort Key'],
            'product_type' => $row['Product Type'],
            'final_MRP' => $row['Final MRP'],
            'final_gender' => $row['Final Gender'],
            'global_ki' => $row['Global KI'],
            'marketing_tier' => $row['Marketing Tier'],
            'channel-w22' => $row['Channel-aw22'],
            'line' => $row['Line'],
            'customer(online)' => $row['Cutomer (Online)'],
            'story' => $row['Story'],
            'colab' => $row['Colab'],
            'upper' => $row['Upper'],
            'mid_sole' => $row['Mid Sole'],
            'out_sole' => $row['Out Sole'],
            'description' => $row['Description'],
            'size_run' => $row['Size Run'],
            'technology' => $row['TECHNOLOGY'],
            'marketing' => $row['MARKETING'],
            'additional' => $row['ADDITIONAL'],
            'key_highlight' => $row['KEY HIGHLIGHT'],
            'fk_retail' => $row['FK Retail'],
            'fk_discount' => $row['FK Discount'],
            'myntra_retail' => $row['Myntra Retail'],
            'myntra_discount' => $row['Myntra Discount'],
            'ajio_retail' => $row['AJIO Retail'],
            'ajio_discount' => $row['AJIO Discount'],
            'amazon_discount' => $row['Amazon Discount'],
        ]);
        $this->data->push($model);
        return $model;
    }
}
