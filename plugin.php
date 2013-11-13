<?php

/**
 * Sniff the useragent and expose data to the front end
 */

class PhileUserAgent extends \Phile\Plugin\AbstractPlugin implements \Phile\EventObserverInterface {
	public function __construct() {
		\Phile\Event::registerEvent('template_engine_registered', $this);
	}

	public function on($eventKey, $data = null) {
		if ($eventKey == 'template_engine_registered') {
			require_once('sniffer.php');
			$data['data']['useragent'] = $sniffer;
		}
	}
}
