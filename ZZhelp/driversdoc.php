<div class="w-full">
    <?php
    Input([
        'id' => 'license_front_photo',
        'label' => 'Liicense Front Photo',
        'type' => 'file',
        'iclass' => 'hidden'
    ]);
    ?>
    <label for="license_front_photo" id="label_license_front_photo"
        class="file-name w-full rounded-lg bg-white p-4 flex justify-center item-center border-gray">Choose
        Front Photo</label>
</div>
<div class="w-full">
    <?php
    Input([
        'id' => 'license_back_photo',
        'label' => 'Liicense Back Photo',
        'type' => 'file',
        'iclass' => 'hidden'
    ]);
    ?>
    <label for="license_back_photo" id="label_license_back_photo"
        class="file-name w-full rounded-lg bg-white p-4 flex justify-center item-center border-gray">Choose
        Back Photo</label>
</div>

<div class="w-full">
    <?php
    Input([
        'id' => 'id_front_photo',
        'label' => 'Government Id Front Photo',
        'type' => 'file',
        'iclass' => 'hidden'
    ]);
    ?>
    <label for="id_front_photo" id="label_id_front_photo"
        class="file-name w-full p-4 rounded-lg  bg-white flex justify-center item-center border-gray">Choose
        Front Photo</label>
</div>
<div class="w-full">
    <?php
    Input([
        'id' => 'id_back_photo',
        'label' => 'Government Id back Photo',
        'type' => 'file',
        'iclass' => 'hidden'
    ]);
    ?>
    <label for="id_back_photo" id="label_id_back_photo"
        class="file-name w-full rounded-lg bg-white p-4 flex justify-center item-center border-gray">Choose
        Back Photo</label>
</div>
</div>