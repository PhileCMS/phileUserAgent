<?php
/**
 * Plugin class
 */
namespace Phile\Plugin\Phile\UserAgent;

/**
 * Sniff the useragent and expose data to the front end
 */
class Plugin extends \Phile\Plugin\AbstractPlugin implements \Phile\Gateway\EventObserverInterface {
	/**
	 * the constructor
	 */
	public function __construct() {
		\Phile\Event::registerEvent('template_engine_registered', $this);
	}

	/**
	 * event method
	 * @param string $eventKey
	 * @param null   $data
	 *
	 * @return mixed|void
	 */
	public function on($eventKey, $data = null) {
		if ($eventKey == 'template_engine_registered') {
			$data['data']['useragent'] = Sniffer::getInformations();
			$detect = new Mobile_Detect;
			$data['data']['useragent']['device_type'] = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
		}
	}
}
