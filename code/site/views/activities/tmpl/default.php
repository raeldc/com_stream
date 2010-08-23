<style src="media://com_stream/css/style.css" />

<?
$targets = KFactory::tmp('site::com.stream.model.targets')->getList()->getData();
$thing = reset($targets); 

$string = substr($thing['title'], 3);
$option = strtolower(substr($string, 0, stripos($string, 'controller')));
$view = strtolower(substr($string, stripos($string, 'controller')+10));
$model = KInflector::pluralize($view);

$list = KFactory::tmp('site::com.'.$option.'.model.'.$model)->getList()->getData();
$array = array();

foreach ($list as $item)
{
    $array[] = $item['id'];
}
?>

<? if (!count(@$myactivities)) : ?>
    <p>
    No activities logged yet    
    </p>
<? else : ?>

<table class="u-stream" >
    <? $currentDay = null; ?>
    <? foreach (@$myactivities as $activity) : ?>
    
        <? 
        if (!in_array($activity->parent_target_id, $array))
        {
            continue;
        }
        ?>

	 	<? 		
	 	$date = new KDate();
        $offset = KFactory::get('lib.joomla.config')->getValue('config.offset')+1;
		$date->setDate($activity->created_on)->addHours($offset);
		?>
		<? if ($currentDay == $date->format('%d %B')) : ?>
     	    <tr> 
     	        <td class="empty">&nbsp;</td> 
     	<? else : ?>
     	    <tr class="new-day"> 
     	        <td class="day"> 
     	            <span>
     	                <a><?= $date->format('%d %b')?></a>
     	            </span> 
     	        </td>
		<? endif; ?>
        <? $currentDay = $date->format('%d %B'); ?>
                <td class="hour"> 
                    <span>
                        <a>                            
                            <?= $date->format('%R'); ?>
                        </a>
                    </span> 
                </td> 
                <td class="description">
                    <span class="user-info"> 
                        <? $user = KFactory::tmp('lib.joomla.user', array('id' => $activity->created_by)); ?>
		            	<img alt="Avatar" class="photo" title="<?=$user->name; ?>" src='http://www.gravatar.com/avatar.php?gravatar_id=<?php echo md5(strtolower($user->email)); ?>&size=27'>
                        <?=$user->name?>
                    </span> 
                    <span> 
                        <? 
                        $string = substr($activity->controller, 3);
                        $option = strtolower(substr($string, 0, stripos($string, 'controller')));
                        $view = strtolower(substr($string, stripos($string, 'controller')+10));
                        ?>
                        <?=@text($activity->controller.'-'.$activity->action)?> 
                        <? if ($activity->action != 'delete') : ?>
                            <a href="<?=@route('option=com_'.$option.'&view='.$view.'&id='.$activity->target_id.'&parent_target_id='.$activity->parent_target_id)?>" style="width:100%;">                                    
                            <em>#<?=$activity->target_title?></em>
                            </a>
                        <? else : ?>
                           <em>#<?=$activity->target_title?></em>
                        <? endif; ?>

                        <? if (!KRequest::get('get.parent_target_id', 'int')) : ?>
                            <?
                            $targets = KFactory::tmp('site::com.stream.model.targets')->getList()->getData();
                            $thing = reset($targets); 
                            $string = substr($thing['title'], 3);
                            $option = strtolower(substr($string, 0, stripos($string, 'controller')));
                            $view = strtolower(substr($string, stripos($string, 'controller')+10));
                            $model = KInflector::pluralize($view);
                            $data =  KFactory::tmp('site::com.'.$option.'.model.'.$model)->id($activity->parent_target_id)->getItem()->getData();
                            echo '<strong>'.$data['title'].'</strong>';
                            ?>
                        <? endif; ?>
                    </span> 
                </td> 
             </tr>  
	<? endforeach; ?>
</table>
<br />

<? if ($total > 20 && $pagination!='off') : ?>
    <?= @helper('paginator.pagination', array('total' => $total)) ?>
<? endif; ?>

<? endif; ?>