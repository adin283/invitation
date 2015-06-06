<?php

if (APPLICATION_ENV != 'development' && APPLICATION_ENV != 'testing') {
	return array(
		'JS_PATH'		=> 'http://zwbweddingfile.b0.upaiyun.com/js/',
		'CSS_PATH'		=> 'http://zwbweddingfile.b0.upaiyun.com/css/',
		'IMAGES_PATH'	=> 'http://zwbwedding.b0.upaiyun.com/images/',
		'MUSIC_PATH'	=> 'http://zwbweddingfile.b0.upaiyun.com/music/',
	);
} else {
	return array(
		'JS_PATH'		=> '/Public/js/',
		'CSS_PATH'		=> '/Public/css/',
		'IMAGES_PATH'	=> '/Public/images/',
		'MUSIC_PATH'	=> '/Public/music/',
	);
}

