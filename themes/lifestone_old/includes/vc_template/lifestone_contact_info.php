<?php
$address = $phone = $mail = '';
$atts = lifestone_set_default('alignment', 'horizontal', $atts);
$atts = vc_map_get_attributes( 'lifestone_contact_info', $atts );
extract($atts);
if($alignment == 'horizontal'){  ?>

    <div class="wrap-contact">
        <?php if(!empty($address)){ ?>
            <div class="col-md-4 col-sm-12 item-contact contact-height">
                <i class="fa fa-map-marker"></i>
                <h5 class="title"><?php echo esc_html__('ADDRESS', 'lifestone'); ?></h5>
                <?php echo wp_kses_post( $address ); ?>
            </div>
        <?php } ?>

        <?php if(!empty( $phone )){ ?>
            <div class="col-md-4 col-sm-12 item-contact contact-height">
                <i class="fa fa-phone"></i>
                <h5 class="title"><?php echo esc_html__('PHONES', 'lifestone'); ?></h5>
                <?php echo wp_kses_post( $phone ); ?>
            </div>
        <?php } ?>

        <?php if(!empty( $content )) { ?>

            <div class="col-md-4 col-sm-12 item-contact contact-height">
                <i class="fa fa-envelope"></i>
                <h5 class="title"><?php echo esc_html__('OUR MAIL', 'lifestone'); ?></h5>
                <?php echo wp_kses_post( $content ); ?>
            </div>
        <?php } ?>

    </div>
<?php } else { ?>
    <div class="contact-title">
        <h2><?php echo esc_html__('Contact information', 'lifestone'); ?></h2>
    </div>

    <ul class="list-icon">
        <?php if(!empty($address)){ ?>
            <li><i class="fa fa-globe"></i> <?php echo wp_kses_post( $address ); ?></li>
        <?php } ?>
        <?php if(!empty( $mail )) { ?>
            <li><i class="fa fa-envelope"></i> <?php echo wp_kses_post( $mail );  ?></li>
        <?php } ?>
        <?php if(!empty( $phone )){ ?>
            <li><i class="fa fa-phone"></i> <?php echo wp_kses_post( $phone ); ?></li>
        <?php } ?>
    </ul>
<?php } ?>