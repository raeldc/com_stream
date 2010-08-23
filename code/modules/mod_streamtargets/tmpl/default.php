<?
$projects = KFactory::tmp('site::com.stream.model.targets')->getList()->getData();
$thing = reset($projects); 

$string = substr($thing['title'], 3);
$option = strtolower(substr($string, 0, stripos($string, 'controller')));
$view = strtolower(substr($string, stripos($string, 'controller')+10));
$model = KInflector::pluralize($view);

$targetModel = KFactory::tmp('site::com.'.$option.'.model.'.$model);
$list = $targetModel->getList()->getData();

$user = KFactory::get('lib.joomla.user');
?>
<ul>
	<li>
		<a href="<?=@route('&parent_target_id=0')?>">All</a>
		<a href="index.php?option=com_stream&view=activities&format=feed&username=<?=$user->username?>&userid=<?=$user->id?>"><img src="media/com_stream/images/rss.png" /></a>
	</li>
<? foreach ($list as $item) : ?>
    <li>
    	<a href="<?=@route('&parent_target_id='.$item['id'])?>"><?=$item['title'];?></a>
    	<a href="index.php?option=com_stream&view=activities&format=feed&username=<?=$user->username?>&userid=<?=$user->id?>&parent_target_id=<?=$item['id']?>"><img src="media/com_stream/images/rss.png" /></a>
    </li>
<? endforeach; ?>
</ul>