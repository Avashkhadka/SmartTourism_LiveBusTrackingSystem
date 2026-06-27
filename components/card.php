<?php
function Card($class, $content,$style)
{
    ?>
    <div class="<?php echo $class ?> py-8 rounded-lg border-solid border-1 " style="border:1px solid #e1e1e2; <?php echo $style ?>">
        <div><?php echo $content['title'] ?></div>
        <div><?php echo $content['desc'] ?></div>



    </div>
    <?php
}
?>