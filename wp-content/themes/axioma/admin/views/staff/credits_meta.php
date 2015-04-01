<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" value="1" name="tmm_meta_saving" />

<table class="form-table">
    <tbody>
        <tr>
            <th style="width:25%">
                <label for="email">
                    <strong><?php _e('Email', 'axioma'); ?></strong>
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                </label>
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" value="<?php echo $email ?>" id="email" name="email">
            </td>
        </tr>
		<tr>
            <th style="width:25%">
                <label for="twitter">
                    <strong><?php _e('Twitter', 'axioma'); ?></strong>
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                </label>
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" value="<?php echo $twitter ?>" id="twitter" name="twitter">
            </td>
        </tr>


        <tr>
            <th style="width:25%">
                <label for="facebook">
                    <strong><?php _e('Facebook', 'axioma'); ?></strong>
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                </label>
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" value="<?php echo $facebook ?>" id="facebook" name="facebook">
            </td>
        </tr>

		<tr>
            <th style="width:25%">
                <label for="dribble">
                    <strong><?php _e('Dribbble', 'axioma'); ?></strong>
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                </label>
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" value="<?php echo $dribble ?>" id="dribble" name="dribble">
            </td>
        </tr>


		<tr>
            <th style="width:25%">
                <label for="skype">
                    <strong><?php _e('Skype', 'axioma'); ?></strong>
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                </label>
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" value="<?php echo $skype ?>" id="skype" name="skype">
            </td>
        </tr>


    </tbody>
</table>
