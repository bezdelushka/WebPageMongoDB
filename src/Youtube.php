<?php
class YouTube {
    public function getVideoID($url) {
        $video_id = '';
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);
        if (isset($params['v'])) {
            $video_id = $params['v'];
        } elseif (preg_match('/(\/)([^\/]+)/', $url_components['path'], $matches)) {
            $video_id = $matches[2];
        }
        return $video_id;
    }
}