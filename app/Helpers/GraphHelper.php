<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 018 18.04.19
 * Time: 14:56
 */

namespace App\Helpers;

use CpChart\Data;
use CpChart\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class GraphHelper
{
    public static $graph_type;
    public static $graph_format;
    public static $start_date;
    public static $end_date;

    public static function convertActivityTypeToQuery($type)
    {
        if ($type == "straight") {
            self::$graph_type = "asc";
        } elseif ($type == "reverse") {
            self::$graph_type = "desc";
        } else {
            self::$graph_type = "asc";
        }

        return self::$graph_type;
    }

    public static function convertActivityRangeToFormat($type)
    {
        if ($type == "week") {
            self::$graph_format = "D";
        }
        elseif ($type == "month") {
            self::$graph_format = "M d";
        }
        else {
            self::$graph_format = 'M';
        }

        return self::$graph_format;
    }

    public static function detectStartDate($type)
    {
        if ($type == "week") {
            $now = Carbon::now();
            self::$start_date = $now->subWeek();
        }
        elseif ($type == "month") {
            $now = Carbon::now();
            self::$start_date = $now->subMonths();
        }
        elseif ($type == "year"){
            $now = Carbon::now();
            self::$start_date = $now->subYear();
        }
        else {
            $now = Carbon::now();
            self::$start_date = $now->subYear();
        }

        return self::$start_date;
    }

    public static function detectEndDate($type)
    {
        if ($type == "week") {
            self::$end_date = Carbon::now();
        } elseif ($type == "month") {
            self::$end_date = Carbon::now();
        } else {
            self::$end_date = Carbon::now();
        }

        return self::$end_date;
    }

    public static function generateGraphImageBase64($activity = null, $records = null)
    {
        $years = array();
        $values = array();

        $i = 0;
        $j = 0;

        foreach($records as $key => $value){

            $maxResult = 0;
            foreach($value as $record){
                if ($record->value > $maxResult){
                    $maxResult = $record->value;
                }
            }

            $years[$i] = $key;
            $values[$j] = $maxResult;

            $i++;
            $j++;
        }

        /* Create and populate the pData object */
        $MyData = new Data();

//        dd($values, $years);

        $MyData->addPoints($values, "Server A");


        $MyData->setAxisName(0,"Hits");

        $MyData->addPoints($years,"Months");

        $MyData->setSerieDescription("Months","Month");
        $MyData->setAbscissa("Months");

        /* Create the floating 0 data serie */
        $MyData->setSerieDrawable("Floating 0",TRUE);

        /* Create the pChart object */
        $myPicture = new Image(700,450,$MyData);
        $myPicture->drawGradientArea(0,0,700,450,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>60));
        $myPicture->drawGradientArea(0,0,700,450,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>15));
        $myPicture->setFontProperties(array("FontName"=>"../fonts/pf_arma_five.ttf","FontSize"=>6));

        /* Create the pChart line */
        $myPicture->drawLine(50,160,680,160,array("R"=>0,"G"=>0,"B"=>0,"Ticks"=>2,"Weight"=>1));


        /* Draw the scale  */
        $myPicture->setGraphArea(50,30,680,400);
        $myPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10));

        /* Turn on shadow computing */
        $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>8));

        /* Draw the chart */
        $settings = array("Floating0Serie"=>"Floating 0","Draw0Line"=>TRUE,"Gradient"=>TRUE, "DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255, "DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);
        $myPicture->drawBarChart($settings);

//        $myPicture->drawLegend(580,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

        /* Render the picture (choose the best way) */
//        $myPicture->autoOutput("pictures/example.drawBarChart.floating.png");

        $myPicture->Render('lol.png');

        $base64 = $myPicture->toDataURI();

        return $base64;



//        /* Create and populate the Data object */
//        $data = new Data();
//
//        $data->addPoints(["Firefox", "Chrome", "Internet Explorer", "Opera", "Safari", "Mozilla", "SeaMonkey", "Camino", "Lunascape"], "Browsers");
//        $data->setSerieDescription("Browsers", "Browsers");
//
//        $data->setAbscissa("Browsers");
//
//        $data->addPoints([13251, 4118, 3087, 1460, 1248, 156, 26, 9, 8], "Hits");
//        $data->setAxisName(0, "Hits");
//
//
//        /* Create the Image object */
//        $image = new Image(500, 500, $data);
//        $image->drawGradientArea(0, 0, 500, 500, DIRECTION_VERTICAL, [
//            "StartR" => 240,
//            "StartG" => 240,
//            "StartB" => 240,
//            "EndR" => 180,
//            "EndG" => 180,
//            "EndB" => 180,
//            "Alpha" => 100
//        ]);
//
//        $image->drawGradientArea(0, 0, 500, 500, DIRECTION_HORIZONTAL, [
//            "StartR" => 240,
//            "StartG" => 240,
//            "StartB" => 240,
//            "EndR" => 180,
//            "EndG" => 180,
//            "EndB" => 180,
//            "Alpha" => 20
//        ]);
//
//        $image->setFontProperties(["FontName" => "pf_arma_five.ttf", "FontSize" => 6]);
//
//        /* Draw the chart scale */
//        $image->setGraphArea(100, 30, 480, 480);
//        $image->drawScale([
//            "CycleBackground" => true,
//            "DrawSubTicks" => true,
//            "GridR" => 0,
//            "GridG" => 0,
//            "GridB" => 0,
//            "GridAlpha" => 10,
//            "Pos" => SCALE_POS_TOPBOTTOM
//        ]);
//
//        /* Turn on shadow computing */
//        $image->setShadow(true, ["X" => 1, "Y" => 1, "R" => 0, "G" => 0, "B" => 0, "Alpha" => 10]);
//
//        /* Draw the chart */
//        $image->drawBarChart(["DisplayPos" => LABEL_POS_INSIDE, "DisplayValues" => true, "Rounded" => false, "Surrounding" => 30]);
//
//        /* Write the legend */
//
////                LEGEND_HORIZONTAL
//        $image->drawLegend(570, 215, ["Style" => LEGEND_NOBORDER, "Mode" => LEGEND_HORIZONTAL]);
//
//        /* Render the picture (choose the best way) */
//
//        $image->autoOutput("example.drawBarChart.vertical.png");
//
//        $image->Render('lol.png');
//
//        $base64 = $image->toDataURI();
//
//        return $base64;
    }

    public static function saveBase64GraphImage($data)
    {
        $folderPath = "images/";
        $image_parts = explode(";base64,", $data);

        if (!$image_parts || !isset($image_parts[1]) || $image_parts[1] == null || $image_parts[1] == "") {
            return null;
        }

        explode("image/", $image_parts[0]);
        $image_base64 = base64_decode($image_parts[1]);
        $imageName = time() . "-" . uniqid() . '.png';

        File::put(storage_path('app/public/images/') . $imageName, $image_base64);
        $path = "/" . $folderPath . $imageName;

        return $path;
    }
}
