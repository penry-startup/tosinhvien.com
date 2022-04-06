<?php

if (! function_exists('get_between_content'))
{
    /**
     * @param string $content
     * @param string $start
     * @param string $end
     * @return string
     */
    function get_between_content($content, $start, $end)
    {
        $r = explode($start, $content);
        if (isset($r[1])) {
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return '';
    }
}

if (! function_exists('write_log_exception'))
{
    /**
     * @param \Exception $e
     * @return void
     */
    function write_log_exception(\Exception $e = null)
    {
        \Log::error('➤Message ex::' . $e->getMessage() . PHP_EOL . '#0 More exception::' . get_between_content($e->getTraceAsString(), '#0', '#10') . PHP_EOL . PHP_EOL);
    }
}


if (! function_exists('get_sender_email'))
{
    /**
     * Get email address by shop or by admin
     * @param model $shop
     * @return string
     */
    function get_sender_email($shop = null)
    {
        if ($shop) {
            return 'shop-test@gmail.com';
        }
        return 'admin-test@gmail.com';
    }
}

if (! function_exists('get_sender_name'))
{
    function get_sender_name($shop = null)
    {
        if ($shop) {
            return 'shop-email-name';
        }
        return 'admin-email-name';
    }
}


if (! function_exists('get_storage_image_url'))
{
    function get_storage_image_url($path, $size = 'default')
    {
        if (empty($path)) {
            return get_placeholder_image($size);
        }

        if (empty($size)) {
            return url($path);
        }

        $size  = config('image.sizes.' . $size);

        return url("{$path}?width={$size['w']}&height={$size['h']}&fit={$size['fit']}");
    }
}

if (! function_exists('get_placeholder_image'))
{
    function get_placeholder_image($size)
    {
        $size = config("image.sizes.{$size}");

        if ($size && is_array($size)) {
            return "https://placehold.it/{$size['w']}x{$size['h']}/eee?fit={$size['fit']}&text=" . trans('app.no_img_available');
        }

        return url("images/placeholders/no_img.png");
    }
}

if (! function_exists('get_placeholder_image'))
{
    function get_placeholder_image($size)
    {
        $size = config("image.sizes.{$size}");

        if ($size && is_array($size)) {
            return "https://placehold.it/{$size['w']}x{$size['h']}/eee?fit={$size['fit']}&text=" . trans('app.no_img_available');
        }

        return url("images/placeholders/no_img.png");
    }
}

if (! function_exists('get_file_version'))
{
    function get_file_version($file)
    {
        return "{$file}?v=" . date('YmdHis', filemtime(public_path($file)));
    }
}

if (! function_exists('svg_icon'))
{
    function svg_icon($filename, $w = 21, $h = 21)
    {
        $filepath = '/assets/img/svg/'. $filename .'.svg';

        if (file_exists(public_path($filepath))) {
            $sw = $w ? 'width=' . $w . 'px' : '';
            $sh = $h ? 'height=' . $h . 'px' : '';
            return '<img '. $sw .' '. $sh .' src="'. $filepath .'" alt="' . $filename . '" />';
        }

        return '';
    }
}
