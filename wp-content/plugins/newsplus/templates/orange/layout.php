<?php
$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $parse_uri[0] . 'wp-load.php';
require_once($wp_load);
$settings = TmMS_Settings::get_settings();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#dbc897">
	<tr>
		<td align="center" valign="top">

			<table width="582" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="10" cellpadding="0">
							<tr>
								<td style="font-family: Arial; font-size:10px; line-height:12px; text-align:center; color:#888;">
									<div class="content_area" id="edit_area_mail_header">
										<?php echo $settings['mail_header'] ?>
									</div>
								</td>
							</tr>
						</table>

					</td>
				</tr>
				<tr>
					<td style="font-size:0; line-height:0;">
						<div class="content_area" id="edit_area_00">
						<a href="<?php echo site_url() ?>"><img src="<?php echo THEMEMAKERS_MAIL_SUBSCRIBER_LINK ?>templates/orange/images/logo.gif" border="0" alt="" /></a>
						</div>
					</td>
				</tr>

				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="10">
							<tr>
								<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td>
												<table width="100%" border="0" cellspacing="10" cellpadding="0" bgcolor="#ebebeb">
													<tr>
														<td>
															<table width="100%" border="0" cellspacing="0" cellpadding="3" bgcolor="#ffffff">
																<tr>
																	<td style="color:#9e4a00; font-size:11px; font-family:Arial; text-align:left;">
																		<div class="content_area" id="edit_area_0"><?php echo date("F j, Y") ?></div>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>

												<div style="line-height:10px; font-size:0;">&nbsp;</div>
											</td>
										</tr>
										<tr>
											<td>
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td valign="top" width="230">
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td style="font-family: Arial; font-size:13px; line-height:17px; text-align:left; color:#747474;">
																		<div class="content_area" id="edit_area_1">
																			<div style="font-family: Arial; font-size:13px; line-height:17px; color:#a94d00; font-weight:bold; text-align:left;">In this issue</div>
																			<ul style="padding:0 15px; margin:0; color:#bc5a00; line-height:20px; ">
																				<li><a href="<?php echo site_url() ?>" style="color:#7e7e7e; text-decoration:underline;">Lorem ipsum dolor.</a></li>
																				<li><a href="<?php echo site_url() ?>" style="color:#7e7e7e; text-decoration:underline;">Sit amet, consectetur.</a></li>
																				<li><a href="<?php echo site_url() ?>" style="color:#7e7e7e; text-decoration:underline;">Cras bibendum</a></li>
																				<li><a href="<?php echo site_url() ?>" style="color:#7e7e7e; text-decoration:underline;">Magna id velit fringilla.</a></li>
																				<li><a href="<?php echo site_url() ?>" style="color:#7e7e7e; text-decoration:underline;">Eu vulputate dui euismod.</a></li>
																			</ul><br />

																			<img src="<?php echo THEMEMAKERS_MAIL_SUBSCRIBER_LINK ?>templates/orange/images/hr-small.gif" height="11" width="230" alt="" />
																		</div>
																	</td>
																</tr>
																<tr>
																	<td style="font-family: Arial; font-size:13px; line-height:17px; text-align:left; color:#747474;">
																		<div class="content_area" id="edit_area_2">
																			<br />
																			<div style="font-family: Arial; font-size:13px; line-height:17px; color:#a94d00; font-weight:bold; text-align:left;">
																				<a href="<?php echo site_url() ?>" style="color:#bc5a00; text-decoration:underline; ">Gravida turpis</a>
																			</div>
																			Vestibulum ante ipsum pri Suspendisse potenti. Proin porta arcu non risus sollicitudin ornare.<br /><br />
																			<img src="<?php echo THEMEMAKERS_MAIL_SUBSCRIBER_LINK ?>templates/orange/images/hr-small.gif" height="11" width="230" alt="" />
																		</div>
																	</td>
																</tr>
																<tr>
																	<td style="font-family: Arial; font-size:13px; line-height:17px; text-align:left; color:#747474;">
																		<div class="content_area" id="edit_area_3">
																			<br />
																			<div style="font-family: Arial; font-size:13px; line-height:17px; color:#a94d00; font-weight:bold; text-align:left;">
																				<a href="<?php echo site_url() ?>" style="color:#bc5a00; text-decoration:underline; ">Phasellus viverra gravida</a></div>
																			Duis eu hendrerit leo. Pibendum nisi dignissim quis. Curabitur accumsan magna ac lorem convallis auctor. <br /><br />
																			<img src="<?php echo THEMEMAKERS_MAIL_SUBSCRIBER_LINK ?>templates/orange/images/hr-small.gif" height="11" width="230" alt="" />
																		</div>
																	</td>
																</tr>
																<tr>
																	<td style="font-family: Arial; font-size:13px; line-height:17px; text-align:left; color:#747474;">
																		<div class="content_area" id="edit_area_4">
																			<br />
																			<div style="font-family: Arial; font-size:13px; line-height:17px; color:#a94d00; font-weight:bold; text-align:left;">
																				<a href="<?php echo site_url() ?>" style="color:#bc5a00; text-decoration:underline; ">Si dolor amet nisl sem metus</a></div>
																			Lorem ipsum dolor suspendisse et nisl sem, at luctus metus. Morbi congue cursus ligula<br /><br />
																			<img src="<?php echo THEMEMAKERS_MAIL_SUBSCRIBER_LINK ?>templates/orange/images/hr-small.gif" height="11" width="230" alt="" />
																		</div>
																	</td>
																</tr>

																<tr>
																	<td style="font-family: Arial; font-size:13px; line-height:17px; text-align:left; color:#747474;">
																		<div class="content_area" id="edit_area_5">
																			<br />
																			<div style="font-family: Arial; font-size:12px; line-height:16px; color:#4c4c4c; font-weight:bold; text-align:left; ">More Articles</div>
																			<ul style="padding:0 15px; margin:0; color:#bc5a00; line-height:20px; ">
																				<li><a href="<?php echo site_url() ?>" style="color:#7e7e7e; text-decoration:underline;">Lorem ipsum dolor.</a></li>
																				<li><a href="<?php echo site_url() ?>" style="color:#7e7e7e; text-decoration:underline;">Sit amet, consectetur.</a></li>
																				<li><a href="<?php echo site_url() ?>" style="color:#7e7e7e; text-decoration:underline;">Cras bibendum</a></li>
																				<li><a href="<?php echo site_url() ?>" style="color:#7e7e7e; text-decoration:underline;">Magna id velit fringilla.</a></li>
																				<li><a href="<?php echo site_url() ?>" style="color:#7e7e7e; text-decoration:underline;">Eu vulputate dui euismod.</a></li>
																			</ul><br />
																		</div>
																	</td>
																</tr>
															</table>

														</td>
														<td valign="top" width="20">&nbsp;</td>
														<td valign="top">
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td style="font-family: Arial; font-size:13px; line-height:17px; text-align:left; color:#747474;">
																		<div class="content_area" id="edit_area_6">
																			<div style="font-family: Arial; font-size:14px; line-height:18px; color:#686868; font-weight:bold; ">Phasellus viverra gravida turpis</div>
																			<img src="<?php echo THEMEMAKERS_MAIL_SUBSCRIBER_LINK ?>templates/orange/images/image.jpg" align="left" hspace="10" vspace="5" alt="" />
																			Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Proin porta arcu non risus sollicitudin ornare. <a href="<?php echo site_url() ?>" style="color:#bc5a00; text-decoration:underline; font-size:10px; text-transform:uppercase;">READ MORE</a><br /><br />
																			<img src="<?php echo THEMEMAKERS_MAIL_SUBSCRIBER_LINK ?>templates/orange/images/hr-middle.gif" height="11" width="309" alt="" />
																		</div>
																	</td>
																</tr>
																<tr>
																	<td style="font-family: Arial; font-size:13px; line-height:17px; text-align:left; color:#747474;">
																		<div class="content_area" id="edit_area_7">
																			<br />
																			<div style="font-family: Arial; font-size:14px; line-height:18px; color:#686868; font-weight:bold; ">Lorem ipsum dolor sit amet</div>
																			Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Proin porta arcu non risus sollicitudi mollis odio auctr. <a href="<?php echo site_url() ?>" style="color:#bc5a00; text-decoration:underline; font-size:10px; text-transform:uppercase;">READ MORE</a><br /><br />
																			<img src="<?php echo THEMEMAKERS_MAIL_SUBSCRIBER_LINK ?>templates/orange/images/hr-middle.gif" height="11" width="309" alt="" />
																		</div>
																	</td>
																</tr>
																<tr>
																	<td style="font-family: Arial; font-size:13px; line-height:17px; text-align:left; color:#747474;">
																		<div class="content_area" id="edit_area_8">
																			<br />
																			<div style="font-family: Arial; font-size:14px; line-height:18px; color:#686868; font-weight:bold; ">Phasellus viverra gravida turpis</div>
																			Vestibulum ante ipsre. Duis eu hendrerit leo. Phasellus viverra gravida turpis, nec bibendum nisi dignissim quis. Curabitur accumsan magna ac lorem convallis non mollis odio auctor. <a href="<?php echo site_url() ?>" style="color:#bc5a00; text-decoration:underline; font-size:10px; text-transform:uppercase;">READ MORE</a><br /><br />
																			<img src="<?php echo THEMEMAKERS_MAIL_SUBSCRIBER_LINK ?>templates/orange/images/hr-middle.gif" height="11" width="309" alt="" />
																		</div>
																	</td>
																</tr>
																<tr>
																	<td style="font-family: Arial; font-size:13px; line-height:17px; text-align:left; color:#747474;">
																		<div class="content_area" id="edit_area_9">
																			<br />
																			<div style="font-family: Arial; font-size:14px; line-height:18px; color:#686868; font-weight:bold; ">Lorem ipsum dolor sit amet</div>
																			Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Proin porta arcu non risus sollicitudi mollis odio auctor. <a href="<?php echo site_url() ?>" style="color:#bc5a00; text-decoration:underline; font-size:10px; text-transform:uppercase;">READ MORE</a><br /><br />
																			<img src="<?php echo THEMEMAKERS_MAIL_SUBSCRIBER_LINK ?>templates/orange/images/hr-middle.gif" height="11" width="309" alt="" />
																		</div>
																	</td>
																</tr>
																<tr>
																	<td style="font-family: Arial; font-size:13px; line-height:17px; text-align:left; color:#747474;">
																		<div class="content_area" id="edit_area_10">
																			<br />
																			<div style="font-family: Arial; font-size:14px; line-height:18px; color:#686868; font-weight:bold; ">Lorem ipsum dolor sit amet</div>
																			Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Proin porta arcu non risus sollicitudi mollis odio auctor. <a href="<?php echo site_url() ?>" style="color:#bc5a00; text-decoration:underline; font-size:10px; text-transform:uppercase;">READ MORE</a><br /><br />
																		</div>
																	</td>
																</tr>

															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td style="">
												<img src="<?php echo THEMEMAKERS_MAIL_SUBSCRIBER_LINK ?>templates/orange/images/hr-big.gif" height="11" width="561" alt="" />
												<div style="font-size:0; line-height:10px;">&nbsp;</div>
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td style="font-family: Arial; font-size:13px; line-height:17px; text-align:left; color:#747474;" valign="top" width="250">
															<div class="content_area" id="edit_area_11">
																<div style="font-family: Arial; font-size:14px; line-height:18px; color:#aa5b12; font-weight:bold; text-align:left; ">Forward to friend</div>
																<img src="<?php echo THEMEMAKERS_MAIL_SUBSCRIBER_LINK ?>templates/orange/images/forward.gif" align="left" hspace="5" vspace="2" alt="" />
																Know someone who might be interested in the email? Why not <a href="<?php echo site_url() ?>" style="color:#bc5a00; text-decoration:underline; ">forward this email</a> to them.
															</div>
														</td>														
													</tr>
												</table>
												<div style="font-size:0; line-height:10px;">&nbsp;</div>											
											</td>
										</tr>
										<tr>
											<td style="">
												<table width="100%" border="0" cellspacing="0" cellpadding="10">
													<tr>
														<td style="font-family: Arial; font-size:10px; line-height:12px; text-align:center; color:#888;">
															<div class="content_area" id="edit_area_mail_footer">
																<?php echo $settings['mail_footer'] ?>
															</div>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>

						</table>
					</td>
				</tr>



			</table>

		</td>
	</tr>
</table>


