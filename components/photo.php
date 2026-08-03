<?php
function Image($props)
{

    $id = $props['id'] ?? '';
    $label = $props['label'] ?? '';
    $dclass = $props['dclass'] ?? 'flex-col';
    $iclass = $props['iclass'] ?? '';
    $lclass = $props['lclass'] ?? '';


    ?>
    <div class="w-full">
        <?php
        Input([
            'id' => $id,
            'label' => "",
            'type' => 'file',
            'iclass' => 'hidden'
        ]);
        ?>
        <label for="<?php echo $id?>" id="label_<?php echo $id?>"
         class="file-name w-full rounded-lg p-4 flex bg-secondary-light bg-secondary-hover border-secondary-hover-dotted justify-center items-center border-gray-dashed color-gray <?php echo $lclass?>"><?php echo $label?></label>
    </div>
    <?php
}

?>