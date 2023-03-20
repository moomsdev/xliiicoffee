<?php
/**
 * Theme Options.
 *
 * Here, you can register Theme Options using the Carbon Fields library.
 *
 * @link    https://carbonfields.net/docs/containers-theme-options/
 *
 * @package WPEmergeCli
 */

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

$optionsPage = Container::make('theme_options', __('Theme Options', 'gaumap'))
                        ->set_page_file('app-theme-options.php')
                        ->add_tab(__('Thương hiệu | Branding', 'gaumap'), [
                            Field::make('image', 'logo' . currentLanguage(), __('Logo', 'gaumap'))->set_width(25),
                            Field::make('image', 'logo_fixed' . currentLanguage(), __('Logo fixed', 'gaumap'))->set_width(25),
                        ])
                        ->add_tab(__('Liên hệ | Contact', 'gaumap'), [
                            Field::make('textarea', 'address' . currentLanguage(), __('Address', 'gaumap'))
                                 ->set_default_value('43 Tran Tan Moi Street, Hoa Thuan Tay, Hai Chau District, Da Nang Province'),
                            Field::make('text', 'email' . currentLanguage(), __('Email', 'gaumap'))
                                 ->set_width(50)
                                 ->set_default_value('infor@43factory.coffee'),
                            Field::make('text', 'phone_number' . currentLanguage(), __('Phone number', 'gaumap'))
                                 ->set_width(50)
                                 ->set_default_value('0799 343 943'),
                            Field::make('complex', 'social_media' . currentLanguage(), __('Add Social media:', 'gaumap'))
                                 ->set_layout('tabbed-horizontal')
                                 ->add_fields([
                                     Field::make('image', 'icon_social', __('Icon', 'gaumap'))->set_width(25),
                                     Field::make('text', 'link_social', __('Link', 'gaumap'))->set_width(75),
                                 ])->set_header_template('<% if (icon_social) { %><%- icon_social %><% } %>'),
                        ])
                        ->add_tab(__('Scripts', 'gaumap'), [
                            Field::make('text', 'crb_google_maps_api_key', __('Google Maps API Key', 'app')),
                            Field::make('header_scripts', 'crb_header_script', __('Header Script', 'app')),
                            Field::make('footer_scripts', 'crb_footer_script', __('Footer Script', 'app')),
                        ]);


// Container::make('theme_options', __('Header', 'gaumap'))
//          ->set_page_file(__('header', 'gaumap'))
//          ->set_page_menu_position(2)
//          ->set_page_menu_title(__('Header', 'gaumap'))
//          ->set_page_parent($optionsPage)
//          ->add_fields([
//              Field::make('image', 'background_header' . currentLanguage(), __('Image', 'gaumap')),
//              Field::make('complex', 'header_slider' . currentLanguage(), __('Add slider:', 'gaumap'))
//                   ->set_layout('tabbed-horizontal')
//                   ->add_fields([
//                       Field::make('textarea', 'text_slider', __('Text', 'gaumap'))->set_width(60),
//                   ]),
//          ]);
