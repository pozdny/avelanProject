<?php
/**
 * Created by PhpStorm.
 * User: Валентина
 * Date: 23.03.14
 * Time: 16:34
 */

class Messages {
    public $Content;

    public function __construct($type, $message, $queryString = ''){
        if($type == 'info'){
            echo $this->Content = $this->showInfoMessage($message, $queryString);
        }
        elseif($type == 'error'){
            echo $this->Content = $this->showErrorMessage($message, $queryString);
        }
        else return;
    }

    private function showInfoMessage( $message, $queryString ){
        global $smarty;
        if(isset($_SESSION['prevPage'])){

            if ( !empty( $queryString ) ){
                $queryString = '/'.$queryString;
                header( 'Refresh: '.REDIRECT_DELAY.'; url='.ADMIN_PANEL.$queryString );
            }
            else{
                header( 'Refresh: '.REDIRECT_DELAY.'; url='.$_SESSION['prevPage'] );
            }
        }
        else{
            if ( !empty( $queryString ) ){
                $queryString = '/'.$queryString;
                header( 'Refresh: '.REDIRECT_DELAY.'; url='.ADMIN_PANEL.$queryString );
            }
            else{
                header( 'Refresh: '.REDIRECT_DELAY.'; url='.ADMIN_PANEL );
            }
        }
        $smarty->assign('content', $message);
        $html = $smarty->fetch('inner-tpl/infoMessage.tpl');
        return $html;
    }
    private function showErrorMessage( $message, $queryString ){
        global $smarty;
        if(isset($_SESSION['prevPage'])){

            if ( !empty( $queryString ) ){
                $queryString = '/'.$queryString;
                //header( 'Refresh: '.REDIRECT_DELAY.'; url='.ADMIN_PANEL.$queryString );
            }
            else{
                //header( 'Refresh: '.REDIRECT_DELAY.'; url='.$_SESSION['prevPage'] );
            }
        }
        else{
            if ( !empty( $queryString ) ){
                $queryString = '/'.$queryString;
                //header( 'Refresh: '.REDIRECT_DELAY.'; url='.ADMIN_PANEL.$queryString );
            }
            else{
                //header( 'Refresh: '.REDIRECT_DELAY.'; url='.ADMIN_PANEL );
            }
        }
        $smarty->assign('content', $message);
        $html = $smarty->fetch('inner-tpl/errorMessage.tpl');
        return $html;
    }

} 