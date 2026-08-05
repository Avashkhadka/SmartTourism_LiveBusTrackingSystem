<?php
function CheckBox($props)
{
    $id = $props['id'] ?? '';
    $lclass = $props['lclass'] ?? '';
    $value = $props['value'] ?? '';

    ?>
    <label class="text-sm color-ternary cursor-pointer <?php echo $lclass; ?>">
        <div class="check-tags flex justify-center items-center color-gray rounded-full py-2 px-4 font-medium text-sm border-gray">
            <?php echo htmlspecialchars($value) ?>
        </div>


        <input type="checkbox" value="<?php echo htmlspecialchars($value) ?>" name="<?php echo $id ?>[]"
            class="hidden checkboxel">
    </label>

    <?php
}

?>