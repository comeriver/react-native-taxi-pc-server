<?php

/**
 * PageCarton
 *
 * LICENSE
 *
 * @category   PageCarton
 * @package    TaxiApp_Booking_List
 * @copyright  Copyright (c) 2017 PageCarton (http://www.pagecarton.org)
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @version    $Id: List.php Wednesday 20th of December 2017 03:21PM ayoola@ayoo.la $
 */

/**
 * @see PageCarton_Widget
 */

class TaxiApp_Booking_List extends TaxiApp_Booking_Abstract
{
 	
    /**
     * 
     * 
     * @var string 
     */
	  protected static $_objectTitle = 'List';   

    /**
     * Performs the creation process
     *
     * @param void
     * @return void
     */	
    public function init()
    {
      $this->setViewContent( $this->getList() );		
    } 
	
    /**
     * Paginate the list with Ayoola_Paginator
     * @see Ayoola_Paginator
     */
    protected function createList()
    {
		require_once 'Ayoola/Paginator.php';
		$list = new Ayoola_Paginator();
		$list->pageName = $this->getObjectName();
		$list->listTitle = self::getObjectTitle();
		$list->setData( $this->getDbData() );
		$list->setListOptions( 
								array( 
							//			'Sub Domains' => '<a rel="spotlight;" onClick="ayoola.spotLight.showLinkInIFrame( \'' . Ayoola_Application::getUrlPrefix() . '/tools/classplayer/get/object_name/Application_Domain_SubDomainList/\' );" title="">Sub Domains</a>',    
									) 
							);
		$list->setKey( $this->getIdColumn() );
		$list->setNoRecordMessage( 'No data added to this table yet.' );
		
		$list->createList
		(
			array(
                    'Booking ID' => array( 'field' => 'booking_id', 'value' =>  '%FIELD%', 'filter' =>  '' ), 
                    'destination' => array( 'field' => 'destination', 'value' =>  '%FIELD%', 'filter' =>  '' ), 
                    'Booked' => array( 'field' => 'creation_time', 'value' =>  '%FIELD%', 'filter' =>  'Ayoola_Filter_Time' ), 
                    'status' => array( 'field' => 'status', 'value' =>  '%FIELD%', 'value_representation' =>  self::$_statusMeaning ), 
                    array( 'field' => 'last_status_time', 'value' =>  '%FIELD%', 'filter' =>  'Ayoola_Filter_Time' ), 
                    '' => '%FIELD% <a style="font-size:smaller;" rel="shadowbox;changeElementId=' . $this->getObjectName() . '" href="' . Ayoola_Application::getUrlPrefix() . '/tools/classplayer/get/object_name/TaxiApp_Booking_Info/?' . $this->getIdColumn() . '=%KEY%">Booking Details</a>', 
                    ' ' => '%FIELD% <a style="font-size:smaller;" rel="shadowbox;changeElementId=' . $this->getObjectName() . '" href="' . Ayoola_Application::getUrlPrefix() . '/tools/classplayer/get/object_name/TaxiApp_Booking_Delete/?' . $this->getIdColumn() . '=%KEY%">x</a>', 
				)
		);
		return $list;
    } 
	// END OF CLASS
}
