<?php

/**
 * ThumbnailImageMaker
 *
 * require GD
 *
 * @author     Junichi Ishida <uzulla@himitsukichi.com>
 * @license    MIT License
 * @version    v0.0.1
 * @link       https://gist.github.com/uzulla/9645443
 */

class ThumbnailImageMaker
{
    private $image_resource;
    private $width;
    private $height;
    public $image_type;

    public function load($file_path)
    {
        $image_info = getimagesize($file_path);
        if ($image_info === FALSE) return FALSE;
        $this->image_type = $image_info[2];

        if ($this->image_type === IMAGETYPE_JPEG) {
            $create_result = $this->setImageResource(imagecreatefromjpeg($file_path));
        } elseif ($this->image_type === IMAGETYPE_GIF) {
            $create_result = $this->setImageResource(imagecreatefromgif($file_path));
        } elseif ($this->image_type === IMAGETYPE_PNG) {
            $create_result = $this->setImageResource(imagecreatefrompng($file_path));
        } else {
            return FALSE;
        }
        if ($create_result === FALSE) return FALSE;

        return TRUE;
    }

    private function setImageResource($image_resource)
    {
        if ($image_resource === FALSE) return FALSE;

        $this->image_resource = $image_resource;

        $this->width = imagesx($this->image_resource);
        $this->height = imagesy($this->image_resource);
        if ($this->width === FALSE || $this->height === FALSE) return FALSE;

        return TRUE;
    }

    public function resize($to_width, $to_height, $allow_expand = TRUE)
    {
        if (!$allow_expand && $to_width >= $this->width && $to_height >= $this->height) return TRUE;

        $new_image = imagecreatetruecolor($to_width, $to_height);
        imagecopyresampled(
            $new_image,
            $this->image_resource,
            0, 0,
            0, 0,
            $to_width,
            $to_height,
            $this->width,
            $this->height
        );
        return $this->setImageResource($new_image);
    }

    public function resizeToHeight($to_height, $allow_expand = TRUE)
    {
        if (!$allow_expand && $to_height >= $this->height) return TRUE;
        $aspect_ratio = $to_height / $this->height;
        $to_width = $this->width * $aspect_ratio;
        return $this->resize($to_width, $to_height);
    }

    public function resizeToWidth($to_width, $allow_expand = TRUE)
    {
        if (!$allow_expand && $to_width >= $this->width) return TRUE;
        $aspect_ratio = $to_width / $this->width;
        $to_height = $this->height * $aspect_ratio;
        return $this->resize($to_width, $to_height);
    }

    public function resizeToWidthInCenter($to_width, $to_height, $allow_expand = TRUE)
    {
      if (!$allow_expand && $to_width >= $this->width && $to_height >= $this->height) return TRUE;

      $new_image = imagecreatetruecolor($to_width, $to_height);

      // 求める画像サイズとの比を求める
      $width_gap = $this->width / $to_width;
      $height_gap = $this->height / $to_height;

      // 横より縦の比率が大きい場合は、求める画像サイズより縦長
      //  => 縦の上下をカット
      if ($width_gap < $height_gap) {
        $cut = ceil((($height_gap - $width_gap) * $to_height) / 2);
        imagecopyresampled($new_image, $this->image_resource, 0, 0, 0, $cut, $to_width, $to_height, $this->width, $this->height - ($cut * 2));

      // 縦より横の比率が大きい場合は、求める画像サイズより横長
      //  => 横の左右をカット
      } elseif ($height_gap < $width_gap) {
        $cut = ceil((($width_gap - $height_gap) * $to_width) / 2);
        imagecopyresampled($new_image, $this->image_resource, 0, 0, $cut, 0, $to_width, $to_height, $this->width - ($cut * 2), $this->height);

      // 縦横比が同じなら、そのまま縮小
      } else {
        imagecopyresampled($new_image, $this->image_resource, 0, 0, 0, 0, $to_width, $to_height, $this->width, $this->height);
      }

      return $this->setImageResource($new_image);
    }

    function save($filename, $image_type = IMAGETYPE_JPEG, $jpeg_compression = 75)
    {
        if ($image_type === IMAGETYPE_JPEG) {
            $write_result = imagejpeg($this->image_resource, $filename, $jpeg_compression);
        } elseif ($image_type === IMAGETYPE_GIF) {
            $write_result = imagegif($this->image_resource, $filename);
        } elseif ($image_type === IMAGETYPE_PNG) {
            $write_result = imagepng($this->image_resource, $filename);
        } else {
            return FALSE;
        }
        if ($write_result === FALSE) return FALSE;

        return TRUE;
    }

}
