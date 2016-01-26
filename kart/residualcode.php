<?
	if(checkjoin($uid,$gid))
	{
		?>
        <font color="#666666" size="-1">Joined</font> ( <font size="-2"><a href="index.php?option=com_content&view=article&id=30&gid=<?=$gid?>&action=leave" style="text-decoration:none">Leave Group</a></font> )
        <?
	}
	else
	{?>
		<form id="form2" name="form2" method="post" action="index.php?option=com_content&view=article&id=30&gid=<?=$gid?>">
      <label>
        <input type="submit" name="join" id="button2" value="Join group" />
       </label>
    </form>
	<?
    }
	?>
	
    <a data-lightbox="width:1000;height:700" href="kart/contact.php?aid=<?=$ad['id']?>" class="myButton">Contact Seller</a></td>
  