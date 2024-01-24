<?php

/**
 * Class used for quick debugging
 *
 */

namespace knowit\helper;

class Util {

	/**
	 * Write any number and any argument given
	 *
	 * @since 1.0.0
	 *
	 */
	static function debug() {
		$args = func_get_args();

		if ( ! empty( $args ) ) {
			foreach ( $args as $arg ) {
				echo '<pre>' . print_r( $arg, true ) . '</pre><br />';
			}
		}

	}

	static function logger() {
		$args = func_get_args();

		if ( ! empty( $args ) ) {
			foreach ( $args as $arg ) {
				error_log( print_r( $arg, true ) );
			}
		}

	}		

	public static function get_valid_files( $content, $file_extensions = array(), $external = false ) {

		$dom = new \DOMDocument;
		@$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );

		$files = array();
		$i     = 0;
		foreach ( $dom->getElementsByTagName( 'a' ) as $node ) {

			$ext = pathinfo( $node->getAttribute( 'href' ), PATHINFO_EXTENSION );

			// look for queried files.
			if ( in_array( $ext, $file_extensions ) ) {

				$id = attachment_url_to_postid( $node->getAttribute( 'href' ) );

				//exclude external links
				if ( $id !== 0 ) {
					$files[ $i ]['id']         = attachment_url_to_postid( $node->getAttribute( 'href' ) );
					$files[ $i ]['href']       = $node->getAttribute( 'href' );
					$files[ $i ]['href_html']  = rawurldecode( $dom->saveHTML( $node ) );
					$files[ $i ]['title']      = $node->nodeValue;
					$files[ $i ]['extension']  = $ext;
					$files[ $i ]['size']       = self::get_file_size( get_attached_file( $id ) );
					$files[ $i ]['size_print'] = self::get_file_format_size( self::get_file_size( get_attached_file( $id ) ) );
					$files[ $i ]['date']       = get_the_date( 'Y-m-d H:i:s', $id );
					$files[ $i ]['date_print'] = strftime( '%e %B %G', strtotime( get_the_date( 'd F y', $id ) ) );
				}
			}
			$i++;

		}
		return $files;

	}

	static function get_file_size( $path_to_file ) {

		if ( file_exists( $path_to_file ) ) {
			return filesize( $path_to_file );
		}

		return false;

	}

	static function get_file_format_size( $file_size ) {
		$sizes = array( ' bytes', ' kb', ' mb', ' gb' );

		// to get comma sign instead of dots.
		setlocale( LC_ALL, 'sv_SE.UTF-8' );

		if ( $file_size === 0 ) {
			return 'n/a';
		} else {
			$temp = round( $file_size / pow( 1000, ( $i = floor( log( $file_size, 1000 ) ) ) ), 1 );
			return $temp . $sizes[ $i ];
		}
	}

	static function strip_content( $content ) {

		// remove script tag and content inside script tag
		$content = preg_replace( '#<script(.*?)>(.*?)</script>#is', '', $content );

		$allowed_html        = wp_kses_allowed_html();
		$allowed_html['ol']  = array();
		$allowed_html['ul']  = array();
		$allowed_html['li']  = array();
		$allowed_html['div'] = array();
		$allowed_html['img'] = array(
			'src' => 1,
			'width' => 1,
			'height' => 1,
			'alt' => 1,
			'title' => 1,
			'class' => 1,
		);

		//adding attr class to be allowed for all tags
		foreach ( $allowed_html as $key => $allowed ) {
			$allowed_html[ $key ]          = $allowed;
			$allowed_html[ $key ]['class'] = 1;
		}

		$content = wp_kses( $content, $allowed_html );

		return $content;
	}

}

//  tail -f debug.log 