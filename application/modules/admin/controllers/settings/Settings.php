<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Settings extends ADMIN_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Languages_model', 'Settings_model']);
    }

    public function index()
    {
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('editsettings', $adminid)) {
            redirect('admin');
        }
        $data = [];
        $head = [];
        $head['title'] = 'Administration - Settings';
        $head['description'] = '';
        $head['keywords'] = '';

        $this->postChecker();

        $value_stores = $this->getValueStores();
        if (!is_null($value_stores)) {
            // Map to data
            foreach ($value_stores as $value_s) {
                if (!array_key_exists($value_s['thekey'], $data)) {
                    $data[$value_s['thekey']] = $value_s['value'];
                }
            }
            unset($value_stores);
        }

        $data['cookieLawInfo'] = $this->getCookieLaw();
        $data['languages'] = $this->Languages_model->getLanguages();
        $data['law_themes'] = array_diff(
            scandir(
                '.' .
                    DIRECTORY_SEPARATOR .
                    'assets' .
                    DIRECTORY_SEPARATOR .
                    'imgs' .
                    DIRECTORY_SEPARATOR .
                    'cookie-law-themes' .
                    DIRECTORY_SEPARATOR
            ),
            ['..', '.']
        );
        $data['cookieLawInfo'] = $this->getCookieLaw();
        $this->load->view('_parts/header', $head);
        $this->load->view('settings/settings', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Settings Page');
    }

    private function getValueStores()
    {
        $values = $this->Settings_model->getValueStores();
        if (is_array($values) && count($values) > 0) {
            return $values;
        }
        return null;
    }

    private function postChecker()
    {
        if (isset($_POST['uploadimage'])) {
            $config['upload_path'] =
                '.' .
                DIRECTORY_SEPARATOR .
                'attachments' .
                DIRECTORY_SEPARATOR .
                'site_logo' .
                DIRECTORY_SEPARATOR;
            $config['allowed_types'] = 'gif|jpg|png';
            // $config['max_size'] = 1500;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 768;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('sitelogo')) {
                $this->session->set_flashdata(
                    'resultSiteLogoPublish',
                    $this->upload->display_errors()
                );
            } else {
                $data = ['upload_data' => $this->upload->data()];
                $newImage = $data['upload_data']['file_name'];
                $this->Home_admin_model->setValueStore('sitelogo', $newImage);
                $this->saveHistory('Change site logo');
                $this->session->set_flashdata(
                    'resultSiteLogoPublish',
                    'New logo is set!'
                );
            }
            redirect('admin/settings');
        }

        if (isset($_POST['PrelaunchPublish'])) {
            $config['upload_path'] =
                '.' .
                DIRECTORY_SEPARATOR .
                'attachments' .
                DIRECTORY_SEPARATOR .
                'site_logo' .
                DIRECTORY_SEPARATOR;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 1500;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('prelaunchimg')) {
                $this->session->set_flashdata(
                    'resultPrelaunchPublish',
                    $this->upload->display_errors()
                );
            } else {
                $data = ['upload_data' => $this->upload->data()];
                $newImage = $data['upload_data']['file_name'];
                $this->Home_admin_model->setValueStore(
                    'prelaunchimg',
                    $newImage
                );
                $this->saveHistory('Change site Pre-launch');
                $this->session->set_flashdata(
                    'resultPrelaunchPublish',
                    'New Pre-launch is set!'
                );
            }
            redirect('admin/settings');
        }

        if (isset($_POST['banner1'])) {
            $config['upload_path'] =
                '.' .
                DIRECTORY_SEPARATOR .
                'attachments' .
                DIRECTORY_SEPARATOR .
                'banner' .
                DIRECTORY_SEPARATOR;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 1500;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 768;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('banner1')) {
                $this->session->set_flashdata(
                    'resultBanner1',
                    $this->upload->display_errors()
                );
            } else {
                $data = ['upload_data' => $this->upload->data()];
                $newImage = $data['upload_data']['file_name'];
                $this->Home_admin_model->setValueStore('banner1', $newImage);
                $this->saveHistory('Change Banner1');
                $this->session->set_flashdata(
                    'resultBanner1',
                    'New Banner1 is set!'
                );
            }
            redirect('admin/settings');
        }

        if (isset($_POST['banner2'])) {
            $config['upload_path'] =
                '.' .
                DIRECTORY_SEPARATOR .
                'attachments' .
                DIRECTORY_SEPARATOR .
                'banner' .
                DIRECTORY_SEPARATOR;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 1500;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 768;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('banner2')) {
                $this->session->set_flashdata(
                    'resultBanner2',
                    $this->upload->display_errors()
                );
            } else {
                $data = ['upload_data' => $this->upload->data()];
                $newImage = $data['upload_data']['file_name'];
                $this->Home_admin_model->setValueStore('banner2', $newImage);
                $this->saveHistory('Change Banner1');
                $this->session->set_flashdata(
                    'resultBanner1',
                    'New Banner2 is set!'
                );
            }
            redirect('admin/settings');
        }

        if (isset($_POST['naviText'])) {
            $this->Home_admin_model->setValueStore(
                'navitext',
                $_POST['naviText']
            );
            $this->session->set_flashdata(
                'resultNaviText',
                'New navigation text is set!'
            );
            $this->saveHistory('Change navigation text');
            redirect('admin/settings');
        }
        if (isset($_POST['footerCopyright'])) {
            $this->Home_admin_model->setValueStore(
                'footercopyright',
                $_POST['footerCopyright']
            );
            $this->session->set_flashdata(
                'resultFooterCopyright',
                'New navigation text is set!'
            );
            $this->saveHistory('Change footer copyright');
            redirect('admin/settings');
        }

        if (isset($_POST['cartlimitset'])) {
            $this->Home_admin_model->setValueStore(
                'cartlimitset',
                $_POST['cartlimitset']
            );
            $this->session->set_flashdata(
                'resultCartlimitset',
                'Change Cart Limit!'
            );
            $this->saveHistory('Change Cart Limit');
            redirect('admin/settings');
        }

        if (isset($_POST['banner'])) {
            $this->Home_admin_model->setValueStore('banner', $_POST['banner']);
            $this->session->set_flashdata('banner', 'New banner text is set!');
            $this->saveHistory('Change banner text');
            redirect('admin/settings');
        }

        if (isset($_POST['bannerlink1'])) {
            $this->Home_admin_model->setValueStore(
                'bannerlink1',
                $_POST['bannerlink1']
            );
            $this->session->set_flashdata(
                'bannerlink1',
                'New Banner Link 1 is set!'
            );
            $this->saveHistory('Change bannerlink1 text');
            redirect('admin/settings');
        }

        if (isset($_POST['bannerlink2'])) {
            $this->Home_admin_model->setValueStore(
                'bannerlink2',
                $_POST['bannerlink2']
            );
            $this->session->set_flashdata(
                'bannerlink2',
                'New Banner Link 2 is set!'
            );
            $this->saveHistory('Change bannerlink2 text');
            redirect('admin/settings');
        }

        if (isset($_POST['bannerheading'])) {
            $this->Home_admin_model->setValueStore(
                'bannerheading',
                $_POST['bannerheading']
            );
            $this->session->set_flashdata(
                'bannerheading',
                'New banner heading text is set!'
            );
            $this->saveHistory('Change banner heading text');
            redirect('admin/settings');
        }

        if (isset($_POST['bannersubheading'])) {
            $this->Home_admin_model->setValueStore(
                'bannersubheading',
                $_POST['bannersubheading']
            );
            $this->session->set_flashdata(
                'bannersubheading',
                'New banner sub-heading text is set!'
            );
            $this->saveHistory('Change banner subheading text');
            redirect('admin/settings');
        }

        if (isset($_POST['addgst'])) {
            $this->Home_admin_model->setValueStore('addgst', $_POST['addgst']);
            $this->session->set_flashdata('addgstpersontage', 'GST is set!');
            $this->saveHistory('Change GST');
            redirect('admin/settings');
        }

        if (isset($_POST['contactsPage'])) {
            $this->Home_admin_model->setValueStore(
                'contactspage',
                $_POST['contactsPage']
            );
            $this->session->set_flashdata(
                'resultContactspage',
                'Contacts page is updated!'
            );
            $this->saveHistory('Change contacts page');
            redirect('admin/settings');
        }
        if (isset($_POST['footerContacts'])) {
            /*echo '<pre>';
				print_r($_POST);
			*/
            $this->Home_admin_model->setValueStore(
                'footerContactAddr',
                $_POST['footerContactAddr']
            );
            $this->Home_admin_model->setValueStore(
                'footerContactStoname',
                $_POST['footerContactStoname']
            );
            $this->Home_admin_model->setValueStore(
                'footerContactPhone',
                $_POST['footerContactPhone']
            );
            $this->Home_admin_model->setValueStore(
                'footerContactwPhone',
                $_POST['footerContactwPhone']
            );
            $this->Home_admin_model->setValueStore(
                'footerContactwAddress',
                $_POST['footerContactwAddress']
            );
            $this->Home_admin_model->setValueStore(
                'footerContactwWeblink',
                $_POST['footerContactwWeblink']
            );
            $this->Home_admin_model->setValueStore(
                'footerContactEmail',
                $_POST['footerContactEmail']
            );
            $this->Home_admin_model->setValueStore(
                'footerContactAccNo',
                $_POST['footerContactAccNo']
            );
            $this->Home_admin_model->setValueStore(
                'footerContactIFSCode',
                $_POST['footerContactIFSCode']
            );
            $this->Home_admin_model->setValueStore(
                'footerContactHoldname',
                $_POST['footerContactHoldname']
            );
            $this->Home_admin_model->setValueStore(
                'footerContactGSTno',
                $_POST['footerContactGSTno']
            );
            $this->session->set_flashdata(
                'resultfooterContacts',
                'Contacts on footer are updated!'
            );
            $this->saveHistory('Change footer contacts');
            redirect('admin/settings');
        }
        if (isset($_POST['footerSocial'])) {
            $this->Home_admin_model->setValueStore(
                'footerSocialFacebook',
                $_POST['footerSocialFacebook']
            );
            $this->Home_admin_model->setValueStore(
                'footerSocialTwitter',
                $_POST['footerSocialTwitter']
            );
            $this->Home_admin_model->setValueStore(
                'footerSocialInstagram',
                $_POST['footerSocialInstagram']
            );
            $this->Home_admin_model->setValueStore(
                'footerSocialLinkedin',
                $_POST['footerSocialLinkedin']
            );
            $this->Home_admin_model->setValueStore(
                'footerSocialPinterest',
                $_POST['footerSocialPinterest']
            );
            $this->Home_admin_model->setValueStore(
                'footerSocialYoutube',
                $_POST['footerSocialYoutube']
            );
            $this->session->set_flashdata(
                'resultfooterSocial',
                'Social on footer are updated!'
            );
            $this->saveHistory('Change footer contacts');
            redirect('admin/settings');
        }
        if (isset($_POST['googleMaps'])) {
            $this->Home_admin_model->setValueStore(
                'googleMaps',
                $_POST['googleMaps']
            );
            $this->Home_admin_model->setValueStore(
                'googleApi',
                $_POST['googleApi']
            );
            $this->session->set_flashdata(
                'resultGoogleMaps',
                'Google maps coordinates and api key are updated!'
            );
            $this->saveHistory('Update Google Maps Coordinates and Api Key');
            redirect('admin/settings');
        }
        if (isset($_POST['footerAboutUs'])) {
            $this->Home_admin_model->setValueStore(
                'footerAboutUs',
                $_POST['footerAboutUs']
            );
            $this->session->set_flashdata(
                'resultFooterAboutUs',
                'Footer about us text changed!'
            );
            $this->saveHistory('Change footer about us info');
            redirect('admin/settings');
        }
        if (isset($_POST['contactsEmailTo'])) {
            $this->Home_admin_model->setValueStore(
                'contactsEmailTo',
                $_POST['contactsEmailTo']
            );
            $this->session->set_flashdata('resultEmailTo', 'Email changed!');
            $this->saveHistory('Change where going emails from contact form');
            redirect('admin/settings');
        }
        if (isset($_POST['shippingOrder'])) {
            $this->Home_admin_model->setValueStore(
                'shippingOrder',
                $_POST['shippingOrder']
            );
            $this->session->set_flashdata(
                'shippingOrder',
                'Shipping Order price chagned!'
            );
            $this->saveHistory(
                'Change Shipping free for order more than ' .
                    $_POST['shippingOrder']
            );
            redirect('admin/settings');
        }
        if (isset($_POST['addJs'])) {
            $this->Home_admin_model->setValueStore('addJs', $_POST['addJs']);
            $this->session->set_flashdata('addJs', 'JavaScript code is added');
            $this->saveHistory('Add JS to website');
            redirect('admin/settings');
        }
        if (isset($_POST['publicQuantity'])) {
            $this->Home_admin_model->setValueStore(
                'publicQuantity',
                $_POST['publicQuantity']
            );
            $this->session->set_flashdata(
                'publicQuantity',
                'Public quantity visibility changed'
            );
            $this->saveHistory('Change publicQuantity visibility');
            redirect('admin/settings');
        }
        if (isset($_POST['publicDateAdded'])) {
            $this->Home_admin_model->setValueStore(
                'publicDateAdded',
                $_POST['publicDateAdded']
            );
            $this->session->set_flashdata(
                'publicDateAdded',
                'Public date added visibility changed'
            );
            $this->saveHistory('Change public date added visibility');
            redirect('admin/settings');
        }
        if (isset($_POST['outOfStock'])) {
            $this->Home_admin_model->setValueStore(
                'outOfStock',
                $_POST['outOfStock']
            );
            $this->session->set_flashdata(
                'outOfStock',
                'Out of stock settings visibility change'
            );
            $this->saveHistory('Change visibility of final checkout page');
            redirect('admin/settings');
        }
        if (isset($_POST['moreInfoBtn'])) {
            $this->Home_admin_model->setValueStore(
                'moreInfoBtn',
                $_POST['moreInfoBtn']
            );
            $this->session->set_flashdata(
                'moreInfoBtn',
                'Button More Information visibility is changed'
            );
            $this->saveHistory(
                'Change visibility of More Information button in products list'
            );
            redirect('admin/settings');
        }
        if (isset($_POST['showBrands'])) {
            $this->Home_admin_model->setValueStore(
                'showBrands',
                $_POST['showBrands']
            );
            $this->session->set_flashdata(
                'showBrands',
                'Brands visibility changed'
            );
            $this->saveHistory('Brands visibility changed');
            redirect('admin/settings');
        }
        if (isset($_POST['virtualProducts'])) {
            $this->Home_admin_model->setValueStore(
                'virtualProducts',
                $_POST['virtualProducts']
            );
            $this->session->set_flashdata(
                'virtualProducts',
                'Virtual products visibility changed'
            );
            $this->saveHistory('Virtual products visibility changed');
            redirect('admin/settings');
        }
        if (isset($_POST['showInSlider'])) {
            $this->Home_admin_model->setValueStore(
                'showInSlider',
                $_POST['showInSlider']
            );
            $this->session->set_flashdata(
                'showInSlider',
                'In Slider products visibility changed'
            );
            $this->saveHistory('In Slider products visibility changed');
            redirect('admin/settings');
        }
        if (isset($_POST['multiVendor'])) {
            $this->Home_admin_model->setValueStore(
                'multiVendor',
                $_POST['multiVendor']
            );
            $this->session->set_flashdata(
                'multiVendor',
                'Multi Vendor Support changed'
            );
            $this->saveHistory('Multi Vendor Support changed');
            redirect('admin/settings');
        }
        if (isset($_POST['setCookieLaw'])) {
            unset($_POST['setCookieLaw']);
            $this->setCookieLaw($_POST);
            $this->saveHistory('Cookie law information changed');
            redirect('admin/settings');
        }
        if (isset($_POST['hideBuyButtonsOfOutOfStock'])) {
            $this->Home_admin_model->setValueStore(
                'hideBuyButtonsOfOutOfStock',
                $_POST['hideBuyButtonsOfOutOfStock']
            );
            $this->session->set_flashdata(
                'hideBuyButtonsOfOutOfStock',
                'Buy buttons of Out of stock products visibility changed'
            );
            $this->saveHistory(
                'Buy buttons visibility changed for out of stock products'
            );
            redirect('admin/settings');
        }
        if (isset($_POST['refreshAfterAddToCart'])) {
            $this->Home_admin_model->setValueStore(
                'refreshAfterAddToCart',
                $_POST['refreshAfterAddToCart']
            );
            $this->session->set_flashdata('refreshAfterAddToCart', 'Saved');
            $this->saveHistory(
                'Option to open shopping cart after click add to cart button changed'
            );
            redirect('admin/settings');
        }
    }

    private function setCookieLaw($post)
    {
        $this->Home_admin_model->setCookieLaw($post);
    }

    private function getCookieLaw()
    {
        return $this->Home_admin_model->getCookieLaw();
    }
}
