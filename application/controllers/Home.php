<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($page = 0)
    {
        $this->db->join(
            'products_translations',
            'products_translations.for_id = products.id',
            'left'
        );
        $this->db->order_by('products.id', 'DESC');
        $this->db->limit(8);
        $this->db->like('products.productviewtype', 'websiteuser');
        $query = $this->db
            ->select(
                'products.id as Id, products.image as image, products.folder as imgfolder, products.product_pcs as Pcs, products_translations.title,products_translations.price, products_translations.old_price'
            )
            ->get('products');
        $data['catalogs'] = $query->result();

        $querysetting = $this->db->get('value_store');
        $result = $querysetting->result_array();

        foreach ($result as $key => $value) {
            $key = $value['thekey'];
            $data[$key] = $value['value'] != '' ? $value['value'] : '';
        }

        $this->db->where('app_slider.slider_type', 'Website');
        $this->db->order_by('app_slider.position', 'ASC');
        $queryslider = $this->db->get('app_slider');
        $data['sliders'] = $queryslider->result();

        $data['page_name'] = 'home';
        $this->load->view('index', $data);
        // $this->load->view($this->module, $data);
    }

    public function aboutus()
    {
        $data['page_name'] = 'aboutus';
        $this->load->view('index', $data);
    }

    public function privacy()
    {
        $data['page_name'] = 'privacy';
        $this->load->view('index', $data);
    }

    public function privacymobile()
    {
        $data['page_name'] = 'privacy';
        $data['webview'] = true;
        $this->load->view('index', $data);
    }

    public function refund()
    {
        $data['page_name'] = 'refund';
        $this->load->view('index', $data);
    }
    public function refundmobile()
    {
        $data['page_name'] = 'refund';
        $data['webview'] = true;
        $this->load->view('index', $data);
    }

    public function term()
    {
        $data['page_name'] = 'term';
        $this->load->view('index', $data);
    }
    public function termmobile()
    {
        $data['page_name'] = 'term';
        $data['webview'] = true;
        $this->load->view('index', $data);
    }

    public function contactus()
    {
        $query = $this->db->get('value_store');
        $result = $query->result_array();
        $data = [];
        foreach ($result as $key => $value) {
            $key = $value['thekey'];
            $data[$key] = $value['value'] != '' ? $value['value'] : '';
        }

        $data['page_name'] = 'contactus';
        $this->load->view('index', $data);
    }

    public function sendmail()
    {
        $query = $this->db->get('value_store');
        $result = $query->result_array();
        $data = [];
        foreach ($result as $key => $value) {
            $key = $value['thekey'];
            $data[$key] = $value['value'] != '' ? $value['value'] : '';
        }

        // $to = "patilmanish12120@gmail.com";
        $to = $data['footerContactEmail'];

        $name = $this->input->post('contact_name');
        $mail = $this->input->post('contact_email');
        $phone = $this->input->post('contact_phone');
        $usermessage = $this->input->post('contact_message');

        // $to = "xyz@somedomain.com";
        $subject = "$name [$phone] Is Sent You mail";

        $message = '<b>Ramrasiya</b>';
        // $message .= "<h1>This is headline.</h1>";
        $message .= "<p>$usermessage</p>";

        // $header = "From:abc@somedomain.com \r\n";
        // $header .= "Cc:afgh@somedomain.com \r\n";
        $header = "MIME-Version: 1.0\r\n";
        $header .= "From: $name <$mail>" . "\r\n";
        $header .= "Content-type: text/html; charset=utf-8\r\n";

        if (mail($to, $subject, $message, $header)) {
            echo 'Message sent successfully...';
        } else {
            echo 'Message could not be sent...';
        }

        // if ($success == true) {
        // } else {
        // }

        // $data['page_name'] = 'contactus';
        // $this->load->view('index', $data);
    }

    public function catalog()
    {
        $limit = 8;
        if (isset($_GET['page'])) {
            $data['page'] = !empty($_GET['page']) ? $_GET['page'] : 1;
        } else {
            $data['page'] = 1;
        }
        $offset = ($data['page'] - 1) * $limit;

        $this->db->join(
            'products_translations',
            'products_translations.for_id = products.id',
            'left'
        );
        $this->db->order_by('products.id', 'DESC');
        $this->db->like('products.productviewtype', 'websiteuser');
        $querytotal = $this->db
            ->select(
                'products.id as Id, products.image as image, products.folder as imgfolder, products.product_pcs as Pcs, products_translations.title,products_translations.price, products_translations.old_price'
            )
            ->get('products');
        $data['totalcatalogs'] = $querytotal->num_rows();

        $this->db->join(
            'products_translations',
            'products_translations.for_id = products.id',
            'left'
        );
        $this->db->order_by('products.id', 'DESC');
        $this->db->limit($limit, $offset);
        $this->db->like('products.productviewtype', 'websiteuser');
        $query = $this->db
            ->select(
                'products.id as Id, products.image as image, products.folder as imgfolder, products.product_pcs as Pcs, products_translations.title,products_translations.price, products_translations.old_price'
            )
            ->get('products');
        //echo $this->db->last_query();exit;
        // $data['catalogs'] = $this->db->order_by('catalog_id', 'DESC')->limit($limit, $offset)->get('catalog')->result();
        $data['total_pages'] = ceil($data['totalcatalogs'] / $limit);
        $data['currentcatalogs'] = $query->num_rows();
        $data['catalogs'] = $query->result();

        $data['page_name'] = 'catalog';
        $this->load->view('index', $data);
    }

    public function catalogdetail()
    {
        $id = $this->input->get('catalog_id');
        if (!$id) {
            show_404();
        }
        $this->db->join(
            'products_translations',
            'products_translations.for_id = products.id',
            'left'
        );
        $this->db->order_by('products.id', 'DESC');
        $this->db->where('products.Id', $id);
        $query = $this->db
            ->select(
                'products.id as Id, products.image as image, products.folder as imgfolder, products.product_pcs as Pcs, products_translations.title,products_translations.price, products_translations.old_price,products_translations.description, products_translations.basic_description'
            )
            ->get('products');
        $data['item'] = $query->row();

        // $data = array();
        $image_link = [];
        $i = 0;
        $singalimg = $data['item']->image;
        if (isset($singalimg) && $singalimg != '') {
            $image_link[0] = !empty($singalimg)
                ? base_url('attachments/shop_images/' . $singalimg)
                : '';
            $a = 1;
        } else {
            $a = 0;
        }
        $multiimg = $data['item']->imgfolder;
        $multiimgarray = $this->productmultiimg($multiimg);

        foreach ($multiimgarray as $key => $value) {
            $image_link[$a] = $value;
            $a++;
        }
        // echo "<pre>";
        // print_r($image_link);
        // exit;
        $data['catalog_image'] = $image_link;

        $this->db->where('product_attribute.productid', $id);
        $queryatt = $this->db
            ->select('product_attribute.*')
            ->get('product_attribute');
        $resultatt = $queryatt->result_array();
        $Attribute = [];
        foreach ($resultatt as $key => $value) {
            $Attribute[$key]['Text'] = $this->attributename($value['keyid']);
            $Attribute[$key]['Value'] = $this->attributename($value['valueid']);
        }

        $data['attribute'] = $Attribute;

        // foreach ($Attribute as $key => $value) {
        // 	echo $value['Text'];
        // }

        // echo "<pre>";
        // // print_r($data);
        // exit;

        $data['page_name'] = 'catalogdetail';
        $this->load->view('index', $data);
    }

    public function attributename($id)
    {
        $query = $this->db->query(
            'SELECT name FROM shop_attribute_translations WHERE id = ' . $id
        );
        $result = $query->row();
        if (isset($result->name)) {
            return $result->name;
        } else {
            return '';
        }
    }

    public function productmultiimg($multiimg, $pos = 0)
    {
        $output = [];
        if (isset($multiimg) && $multiimg != null) {
            $dir =
                'attachments' .
                DIRECTORY_SEPARATOR .
                'shop_images' .
                DIRECTORY_SEPARATOR .
                $multiimg .
                DIRECTORY_SEPARATOR;
            if (is_dir($dir)) {
                if ($dh = opendir($dir)) {
                    $a = 0;
                    while (($file = readdir($dh)) !== false) {
                        if (is_file($dir . $file)) {
                            $extention = strtolower(
                                substr($file, strrpos($file, '.') + 1)
                            );
                            if ($extention != 'pdf') {
                                $output[] = base_url(
                                    'attachments/shop_images/' .
                                        $multiimg .
                                        '/' .
                                        $file
                                );
                            }
                        }
                        $a++;
                    }
                    closedir($dh);
                    sort($output);
                }
            }
        }
        return $output;
    }

    public function savemail()
    {
        $mail = $this->input->post('email');
        if (!empty($mail)) {
            $this->db->where('email', $mail);
            $check = $this->db->select('email')->get('newsletter');

            if ($check->num_rows() == 0) {
                $insert = $this->db->insert('newsletter', ['email' => $mail]);
                if ($insert) {
                    $this->sendWelcomeMail($mail);
                    echo 'Subscribe To Newsletter Successfully...';
                } else {
                    echo 'Something Went Wrong...';
                }
            } else {
                echo 'Already Subscribed Our Newsletter...';
            }
        }
    }

    public function sendWelcomeMail($mail)
    {
        $query = $this->db->get('value_store');
        $result = $query->result_array();
        $data = [];
        foreach ($result as $key => $value) {
            $key = $value['thekey'];
            $data[$key] = $value['value'] != '' ? $value['value'] : '';
        }

        $to = $mail;
        $from = !empty($data['footerContactEmail'])
            ? $data['footerContactEmail']
            : '';
        $name = $data['footerContactStoname'];
        $usermessage = 'Thank You For Subscribing ' . $name;

        $subject = $name . ' Welcome Mail';

        $message = '<b>' . $name . '</b>';
        // $message .= "<h1>This is headline.</h1>";
        $message .= "<p>$usermessage</p>";

        $header = "MIME-Version: 1.0\r\n";
        $header .= "From: $name <$from>" . "\r\n";
        $header .= "Content-type: text/html\r\n";
        if (mail($to, $subject, $message, $header)) {
            return true;
        } else {
            return false;
        }
    }

    public function redirectwebsite()
    {
        if (
            preg_match(
                ' / iPhone | iPod | iPad / ',
                $_SERVER['HTTP_USER_AGENT']
            )
        ) {
            redirect(
                'https://apps.apple.com/in/app/ramrasiya/id1545907020',
                'refresh'
            );
        } elseif (preg_match(' / Android / ', $_SERVER['HTTP_USER_AGENT'])) {
            redirect(
                'https://play.google.com/store/apps/details?id=com.ramrasiya',
                'refresh'
            );
        } else {
            redirect('https://ramrasiya.com/', 'refresh');
        }
    }
}
