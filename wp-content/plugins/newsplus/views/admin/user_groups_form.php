<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php if (!empty($groups)) : ?>
    <?php foreach ($groups as $key => $group) : ?>
        <input <?php if (!empty($users_groups)): ?><?php if (in_array($key, $users_groups)): ?>checked=""<?php endif; ?><?php endif; ?> type="checkbox" class="mail_subscriber_user_set_group" user-id="<?php echo $user_id ?>" value="<?php echo $key ?>">&nbsp;<?php echo $group['name'] ?><br />
    <?php endforeach; ?>
<?php endif; ?>

