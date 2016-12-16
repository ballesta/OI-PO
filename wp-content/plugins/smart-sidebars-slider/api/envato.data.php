<?php

/*
Name:    Smart Envato API: Item And User
Version: 3.3
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: http://www.dev4press.com/

== Copyright ==
Copyright 2008 - 2015 Milan Petrovic (email: milan@gdragon.info)
*/

if (!class_exists('smart_object_sorting')) {
    class smart_object_sorting {
        var $properties;
        var $sorted;

        function  __construct($objects_array, $properties = array()) {
            if (count($properties) > 0) {
                $this->properties = $properties;
                usort($objects_array, array(&$this, 'array_compare'));
            }

            $this->sorted = $objects_array;
        }

        function array_compare($one, $two, $i = 0) {
            $column = $this->properties[$i]['property'];
            $order = $this->properties[$i]['order'];

            if ($one->$column == $two->$column) {
                if ($i < count($this->properties) - 1) {
                    $i++;

                    return $this->array_compare($one, $two, $i);
                } else {
                    return 0;
                }
            }

            if (strtolower($order) == 'asc') {
                return ($one->$column < $two->$column) ? -1 : 1;
            } else {
                return ($one->$column < $two->$column) ? 1 : -1;
            }
        }
    }
}

if (!class_exists('smart_envato_api_user')) {
    class smart_envato_api_user {
        private $_referrer = '';

        public function __construct($user, $referrer = '') {
            foreach ($user as $key => $value) {
                $this->$key = $value;
            }

            $this->_referrer = $referrer;
        }

        public function url($market) {
            $author = 'http://'.strtolower($market).'.net/user/'.$this->username;

            return $this->add_referrer($author);
        }

        public function portfolio_url($market) {
            $author = 'http://'.strtolower($market).'.net/user/'.$this->username.'/portfolio';

            return $this->add_referrer($author);
        }

        private function add_referrer($url) {
            if ($this->_referrer != '') {
                return $url.'?ref='.$this->_referrer;
            } else {
                return $url;
            }
        }
    }
}

if (!class_exists('smart_envato_api_item')) {
    class smart_envato_api_item {
        private $_referrer = '';

        public function __construct($item, $referrer = '', $core = null) {
            if (is_array($item) || is_object($item)) {
                foreach ($item as $key => $value) {
                    $this->$key = $value;
                }
            }

            if (isset($this->live_preview_url)) {
                $this->preview = $this->live_preview_url;
            }

            if (isset($this->url)) {
                $this->domain = parse_url($this->url, PHP_URL_HOST);
                $this->market = substr($this->domain, 0, -4);
            }

            if (isset($this->market) && isset($this->category) && !is_null($core)) {
                $this->categories = $core->data()->category_name($this->market, $this->category);
            }

            $this->_referrer = $referrer;
        }

        public function url() {
            return $this->add_referrer($this->url);
        }

        public function author_url() {
            $author = 'http://'.$this->domain.'/user/'.$this->user;

            return $this->add_referrer($author);
        }

        public function author_portfolio_url() {
            $author = 'http://'.$this->domain.'/user/'.$this->user.'/portfolio';

            return $this->add_referrer($author);
        }

        public function preview_url() {
            $preview = 'http://'.$this->domain.'/item/'.$this->item.'/full_screen_preview/'.$this->id;

            return $this->add_referrer($preview);
        }

        public function screenshots_url() {
            $preview = 'http://'.$this->domain.'/theme_previews/'.$this->id.'-'.$this->item;

            return $this->add_referrer($preview);
        }

        private function add_referrer($url) {
            if ($this->_referrer != '') {
                return $url.'?ref='.$this->_referrer;
            } else {
                return $url;
            }
        }
    }
}

?>