<?php

namespace RT\FashenoCore\Controllers;

use RT\FashenoCore\Traits\SingletonTraits;
use RT\Fasheno\Options\Opt;
use \RT_Posts;

class PostTypeController {
	use SingletonTraits;

	public $post_type;

	public function __construct() {
		$this->post_type = RT_Posts::getInstance();
		//add_action('init', [$this, 'register_post_type'], 5);
	}

}

