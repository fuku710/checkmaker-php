<?php

class Plaid
{
    public $plaid_id, $bg_color, $color1, $color2, $color3;

    public function __construct($plaid_id, $bg_color, $color1, $color2, $color3)
    {
        $this->plaid_id = $plaid_id;
        $this->bg_color = $bg_color;
        $this->color1 = $color1;
        $this->color2 = $color2;
        $this->color3 = $color3;
    }

    public function get_plaid_image()
    {
        $image = new Imagick();
        $draw = new ImagickDraw();

        switch ($this->plaid_id) {
            # グラフチェック
            case 0:
                $draw->pushPattern("pattern", 0, 0, 50, 50);

                $draw->setFillColor($this->bg_color);
                $draw->rectangle(0, 0, 50, 50);
                $draw->setFillColor($this->color1);
                $draw->rectangle(10, 0, 12, 50);
                $draw->rectangle(0, 35, 50, 37);
                $draw->popPattern();

                $draw->setFillPatternURL("#pattern");
                $draw->rectangle(0, 0, 200, 200);

                break;
            # タータン1
            case 1:
                $draw->pushPattern("pattern", 0, 0, 60, 60);

                $draw->setFillColor($this->bg_color);
                $draw->rectangle(0, 0, 60, 60);

                $draw->setFillColor($this->color2);
                $draw->rectangle(5, 0, 35, 65);
                $draw->rectangle(0, 5, 60, 35);

                $draw->setFillColor($this->color1);
                $draw->rectangle(10, 0, 30, 60);
                $draw->rectangle(0, 10, 60, 30);

                $draw->setFillOpacity(0.3);
                $draw->setFillColor($this->bg_color);
                $draw->rectangle(0, 0, 10, 60);
                $draw->rectangle(30, 0, 60, 60);
                $draw->rectangle(0, 0, 60, 20);
                $draw->rectangle(0, 30, 60, 60);

                $draw->setFillOpacity(1.0);
                $draw->setFillColor($this->color2);
                $draw->rectangle(5, 5, 35, 35);

                $draw->setFillOpacity(0.5);
                $draw->setFillColor($this->color1);
                $draw->rectangle(5, 10, 35, 30);
                $draw->rectangle(10, 5, 30, 35);

                $draw->setFillOpacity(1.0);

                $draw->setFillColor($this->color1);
                $draw->rectangle(10, 10, 30, 30);

                $draw->setFillColor($this->color2);
                $draw->rectangle(19, 0, 21, 60);
                $draw->rectangle(49, 0, 51, 60);
                $draw->rectangle(0, 19, 60, 21);
                $draw->rectangle(0, 49, 60, 51);

                $draw->popPattern();

                $draw->setFillPatternURL("#pattern");
                $draw->rectangle(0, 0, 200, 200);
                break;
            # タータン2
            case 2:
                $draw->pushPattern("pattern", 0, 0, 120, 120);

                $draw->setFillColor($this->bg_color);
                $draw->rectangle(0, 0, 120, 120);

                $draw->setFillColor($this->color1);
                $draw->rectangle(0, 60, 60, 120);

                $draw->setFillOpacity(0.5);
                $draw->setFillColor($this->color1);
                $draw->rectangle(0, 0, 60, 120);
                $draw->rectangle(0, 60, 120, 120);

                $draw->setFillOpacity(0.5);
                $draw->setFillColor($this->color2);
                $draw->rectangle(25, 0, 45, 120);
                $draw->rectangle(0, 25, 120, 45);

                $draw->setFillOpacity(1.0);
                $draw->setFillColor($this->color2);
                $draw->rectangle(25, 25, 45, 45);

                $draw->setFillOpacity(0.5);
                $draw->setFillColor($this->color3);
                $draw->rectangle(48, 0, 51, 120);
                $draw->rectangle(54, 0, 57, 120);
                $draw->rectangle(108, 0, 111, 120);
                $draw->rectangle(114, 0, 117, 120);
                $draw->rectangle(0, 48, 120, 51);
                $draw->rectangle(0, 54, 120, 57);
                $draw->rectangle(0, 108, 120, 111);
                $draw->rectangle(0, 114, 120, 117);

                $draw->setFillOpacity(1.0);
                $draw->setFillColor($this->color3);
                $draw->rectangle(48, 48, 51, 51);
                $draw->rectangle(54, 48, 57, 51);
                $draw->rectangle(48, 54, 51, 57);
                $draw->rectangle(54, 54, 57, 57);
                $draw->rectangle(108, 48, 111, 51);
                $draw->rectangle(108, 54, 111, 57);
                $draw->rectangle(114, 48, 117, 51);
                $draw->rectangle(114, 54, 117, 57);
                $draw->rectangle(48, 108, 51, 111);
                $draw->rectangle(54, 108, 57, 111);
                $draw->rectangle(108, 108, 111, 111);
                $draw->rectangle(108, 114, 111, 117);
                $draw->rectangle(114, 108, 117, 111);
                $draw->rectangle(114, 114, 117, 117);

                $draw->popPattern();

                $draw->setFillPatternURL("#pattern");
                $draw->rectangle(0, 0, 200, 200);
                break;
            # タータン3
            case 3:
                $draw->pushPattern("pattern", 0, 0, 100, 100);

                $draw->setFillColor($this->bg_color);
                $draw->rectangle(0, 0, 100, 100);

                $draw->setFillOpacity(0.4);
                $draw->setFillColor($this->color2);
                $draw->rectangle(0, 0, 75, 100);
                $draw->rectangle(95, 0, 100, 100);
                $draw->rectangle(0, 0, 100, 5);
                $draw->rectangle(0, 25, 100, 100);

                $draw->setFillOpacity(1.0);
                $draw->setFillColor($this->color2);
                $draw->rectangle(0, 0, 75, 5);
                $draw->rectangle(95, 0, 100, 5);
                $draw->rectangle(0, 25, 75, 100);
                $draw->rectangle(95, 25, 100, 100);

                $draw->setFillOpacity(0.8);
                $draw->setFillColor($this->color1);
                $draw->rectangle(6, 0, 8, 100);
                $draw->rectangle(10, 0, 12, 100);
                $draw->rectangle(14, 0, 34, 100);
                $draw->rectangle(36, 0, 56, 100);
                $draw->rectangle(58, 0, 60, 100);
                $draw->rectangle(62, 0, 64, 100);
                $draw->rectangle(0, 36, 100, 38);
                $draw->rectangle(0, 40, 100, 42);
                $draw->rectangle(0, 44, 100, 64);
                $draw->rectangle(0, 66, 100, 86);
                $draw->rectangle(0, 88, 100, 90);
                $draw->rectangle(0, 92, 100, 94);

                $draw->setFillOpacity(0.3);
                $draw->setFillColor($this->color2);
                $draw->rectangle(0, 0, 75, 5);
                $draw->rectangle(95, 0, 100, 5);
                $draw->rectangle(0, 25, 75, 100);
                $draw->rectangle(95, 25, 100, 100);

                $draw->setFillOpacity(1.0);
                $draw->setFillColor($this->color1);
                $draw->rectangle(14, 44, 34, 64);
                $draw->rectangle(36, 44, 56, 64);
                $draw->rectangle(14, 66, 34, 86);
                $draw->rectangle(36, 66, 56, 86);
                $draw->rectangle(6, 36, 8, 38);
                $draw->rectangle(10, 40, 12, 42);
                $draw->rectangle(10, 36, 12, 38);
                $draw->rectangle(6, 40, 8, 42);
                $draw->rectangle(58, 36, 60, 38);
                $draw->rectangle(62, 40, 64, 42);
                $draw->rectangle(62, 36, 64, 38);
                $draw->rectangle(58, 40, 60, 42);
                $draw->rectangle(6, 88, 8, 90);
                $draw->rectangle(10, 92, 12, 94);
                $draw->rectangle(10, 88, 12, 90);
                $draw->rectangle(6, 92, 8, 94);
                $draw->rectangle(58, 88, 60, 90);
                $draw->rectangle(62, 92, 64, 94);
                $draw->rectangle(62, 88, 64, 90);
                $draw->rectangle(58, 92, 60, 94);
                $draw->rectangle(6, 44, 8, 64);
                $draw->rectangle(10, 44, 12, 64);
                $draw->rectangle(58, 44, 60, 64);
                $draw->rectangle(62, 44, 64, 64);
                $draw->rectangle(6, 66, 8, 86);
                $draw->rectangle(10, 66, 12, 86);
                $draw->rectangle(58, 66, 60, 86);
                $draw->rectangle(62, 66, 64, 86);
                $draw->rectangle(14, 36, 34, 38);
                $draw->rectangle(14, 40, 34, 42);
                $draw->rectangle(14, 88, 34, 90);
                $draw->rectangle(14, 92, 34, 4);
                $draw->rectangle(36, 36, 56, 38);
                $draw->rectangle(36, 40, 56, 42);
                $draw->rectangle(36, 88, 56, 90);
                $draw->rectangle(36, 92, 56, 94);

                $draw->setFillColor($this->color3);
                $draw->rectangle(85, 0, 87, 100);
                $draw->rectangle(0, 15, 100, 17);

                $draw->popPattern();

                $draw->setFillPatternURL("#pattern");
                $draw->rectangle(0, 0, 200, 200);
                break;
            # 3本線
            case 4:
                $draw->pushPattern("pattern", 0, 0, 60, 60);

                $draw->setFillColor($this->bg_color);
                $draw->rectangle(0, 0, 60, 60);

                $draw->setFillColor($this->color1);
                $draw->rectangle(10, 0, 14, 60);
                $draw->rectangle(26, 0, 30, 60);
                $draw->rectangle(0, 34, 60, 38);
                $draw->rectangle(0, 50, 60, 54);

                $draw->setFillColor($this->color2);
                $draw->rectangle(18, 0, 22, 60);
                $draw->rectangle(0, 42, 60, 46);

                $draw->popPattern();

                $draw->setFillPatternURL("#pattern");
                $draw->rectangle(0, 0, 200, 200);
                break;
            # ガンクラブチェック
            case 5;
                $draw->pushPattern("pattern", 0, 0, 120, 120);

                $draw->setFillColor($this->bg_color);
                $draw->rectangle(0, 0, 120, 120);

                $draw->setFillColor($this->color1);
                $draw->rectangle(10, 70, 40, 100);

                $draw->setFillColor($this->color2);
                $draw->rectangle(70, 10, 100, 40);

                $draw->setFillOpacity(0.5);

                $draw->setFillColor($this->color1);
                $draw->rectangle(10, 0, 40, 120);
                $draw->rectangle(0, 70, 120, 100);

                $draw->setFillColor($this->color2);
                $draw->rectangle(70, 0, 100, 120);
                $draw->rectangle(0, 10, 120, 40);

                $draw->popPattern();

                $draw->setFillPatternURL("#pattern");
                $draw->rectangle(0, 0, 200, 200);
                break;
            # ギンガムチェック
            case 6:
                $draw->pushPattern("pattern", 0, 0, 60, 60);

                $draw->setFillColor("white");
                $draw->rectangle(0, 0, 60, 60);

                $draw->setFillColor($this->color1);
                $draw->rectangle(10, 10, 40, 40);

                $draw->setFillOpacity(0.5);
                $draw->setFillColor($this->color1);
                $draw->rectangle(10, 0, 40, 60);
                $draw->rectangle(0, 10, 60, 40);

                $draw->popPattern();

                $draw->setFillPatternURL("#pattern");
                $draw->rectangle(0, 0, 200, 200);
                break;
            # アーガイルチェック
            case 7:
                $draw->pushPattern("pattern", 0, 0, 88, 176);

                $draw->setFillColor($this->bg_color);
                $draw->rectangle(0, 0, 88, 176);

                $draw->setFillColor($this->color1);
                $draw->pathStart();
                $draw->pathMoveToAbsolute(0, 0);
                $draw->pathLineToAbsolute(0, 44);
                $draw->pathLineToAbsolute(22, 0);
                $draw->pathClose();
                $draw->pathFinish();

                $draw->setFillColor($this->color2);
                $draw->pathStart();
                $draw->pathMoveToAbsolute(22, 0);
                $draw->pathLineToAbsolute(44, 44);
                $draw->pathLineToAbsolute(66, 0);
                $draw->pathClose();
                $draw->pathFinish();

                $draw->setFillColor($this->color1);
                $draw->pathStart();
                $draw->pathMoveToAbsolute(66, 0);
                $draw->pathLineToAbsolute(88, 44);
                $draw->pathLineToAbsolute(88, 0);
                $draw->pathClose();
                $draw->pathFinish();

                $draw->setFillColor($this->color2);
                $draw->pathStart();
                $draw->pathMoveToAbsolute(0, 44);
                $draw->pathLineToAbsolute(22, 88);
                $draw->pathLineToAbsolute(0, 132);
                $draw->pathClose();
                $draw->pathFinish();

                $draw->setFillColor($this->color1);
                $draw->pathStart();
                $draw->pathMoveToAbsolute(22, 88);
                $draw->pathLineToAbsolute(44, 44);
                $draw->pathLineToAbsolute(66, 88);
                $draw->pathLineToAbsolute(44, 132);
                $draw->pathClose();
                $draw->pathFinish();

                $draw->setFillColor($this->color2);
                $draw->pathStart();
                $draw->pathMoveToAbsolute(88, 44);
                $draw->pathLineToAbsolute(66, 88);
                $draw->pathLineToAbsolute(88, 132);
                $draw->pathClose();
                $draw->pathFinish();

                $draw->setFillColor($this->color1);
                $draw->pathStart();
                $draw->pathMoveToAbsolute(0, 132);
                $draw->pathLineToAbsolute(22, 176);
                $draw->pathLineToAbsolute(0, 176);
                $draw->pathClose();
                $draw->pathFinish();

                $draw->setFillColor($this->color2);
                $draw->pathStart();
                $draw->pathMoveToAbsolute(22, 176);
                $draw->pathLineToAbsolute(44, 132);
                $draw->pathLineToAbsolute(66, 176);
                $draw->pathClose();
                $draw->pathFinish();

                $draw->setFillColor($this->color1);
                $draw->pathStart();
                $draw->pathMoveToAbsolute(66, 176);
                $draw->pathLineToAbsolute(88, 132);
                $draw->pathLineToAbsolute(88, 176);
                $draw->pathClose();
                $draw->pathFinish();

                $draw->setStrokeColor($this->color3);
                $draw->pathStart();
                $draw->pathMoveToAbsolute(0, 0);
                $draw->pathLineToAbsolute(88, 176);
                $draw->pathClose();
                $draw->pathFinish();

                $draw->setStrokeColor($this->color3);
                $draw->pathStart();
                $draw->pathMoveToAbsolute(88, 0);
                $draw->pathLineToAbsolute(0, 176);
                $draw->pathClose();
                $draw->pathFinish();

                $draw->setStrokeColor($this->color3);
                $draw->pathStart();
                $draw->pathMoveToAbsolute(44, 0);
                $draw->pathLineToAbsolute(0, 88);
                $draw->pathClose();
                $draw->pathFinish();

                $draw->setStrokeColor($this->color3);
                $draw->pathStart();
                $draw->pathMoveToAbsolute(44, 0);
                $draw->pathLineToAbsolute(88, 88);
                $draw->pathClose();
                $draw->pathFinish();

                $draw->setStrokeColor($this->color3);
                $draw->pathStart();
                $draw->pathMoveToAbsolute(0, 88);
                $draw->pathLineToAbsolute(44, 176);
                $draw->pathClose();
                $draw->pathFinish();

                $draw->setStrokeColor($this->color3);
                $draw->pathStart();
                $draw->pathMoveToAbsolute(88, 88);
                $draw->pathLineToAbsolute(44, 176);
                $draw->pathClose();
                $draw->pathFinish();

                $draw->popPattern();
                $draw->setFillPatternURL("#pattern");
                $draw->rectangle(0, 0, 200, 200);
                break;
        }
        $image->newImage(200, 200, new ImagickPixel($this->bg_color));
        $image->drawImage($draw);
        $image->setImageFormat("png");
        
        return $image;
    }
}
