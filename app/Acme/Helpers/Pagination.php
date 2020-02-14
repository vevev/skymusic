<?php

namespace App\Acme\Helpers;

class Pagination
{
    private static $instance;

    protected $_config = [
        'current_page' => 1,  // Trang hiện tại
        'total_record' => 1,  // Tổng số record
        'total_page'   => 1,  // Tổng số trang
        'limit'        => 10, // limit
        'start'        => 0,  // start
        'link_full'    => '', // Link full có dạng như sau: domain/com/page/{page}
        'link_first'   => '', // Link trang đầu tiên
        'range'        => 9,  // Số button trang bạn muốn hiển thị
        'min'          => 0,  // Tham số min
        'max'          => 0,  // tham số max, min và max là 2 tham số private
    ];

    public static function getInstance()
    {
        if ( ! isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /*
     * Hàm khởi tạo ban đầu để sử dụng phân trang
     */
    public static function init($config = [])
    {
        /*
         * Lặp qua từng phần tử config truyền vào và gán vào config của đối tượng
         * trước khi gán vào thì phải kiểm tra thông số config truyền vào có nằm
         * trong hệ thống config không, nếu có thì mới gán
         */
        foreach ($config as $key => $val) {
            if (isset(self::getInstance()->_config[$key])) {
                self::getInstance()->_config[$key] = $val;
            }
        }

        /*
         * Kiểm tra thông số limit truyền vào có nhỏ hơn 0 hay không?
         * Nếu nhỏ hơn thì gán cho limit = 0, vì trong mysql không cho limit bé hơn 0
         */
        if (self::getInstance()->_config['limit'] < 0) {
            self::getInstance()->_config['limit'] = 0;
        }

        self::getInstance()->_config['total_page'] = ceil(self::getInstance()->_config['total_record'] / self::getInstance()->_config['limit']);

        if ( ! self::getInstance()->_config['total_page']) {
            self::getInstance()->_config['total_page'] = 1;
        }

        if (self::getInstance()->_config['current_page'] < 1) {
            self::getInstance()->_config['current_page'] = 1;
        }

        if (self::getInstance()->_config['current_page'] > self::getInstance()->_config['total_page']) {
            self::getInstance()->_config['current_page'] = self::getInstance()->_config['total_page'];
        }

        self::getInstance()->_config['start'] = (self::getInstance()->_config['current_page'] - 1) * self::getInstance()->_config['limit'];

        $middle = ceil(self::getInstance()->_config['range'] / 2);

        if (self::getInstance()->_config['total_page'] < self::getInstance()->_config['range']) {
            self::getInstance()->_config['min'] = 1;
            self::getInstance()->_config['max'] = self::getInstance()->_config['total_page'];
        }
        // Trường hợp tổng số trang mà lớn hơn range
        else {
            // Ta sẽ gán min = current_page - (middle + 1)
            self::getInstance()->_config['min'] = self::getInstance()->_config['current_page'] - $middle + 1;

            // Ta sẽ gán max = current_page + (middle - 1)
            self::getInstance()->_config['max'] = self::getInstance()->_config['current_page'] + $middle - 1;

            // Sau khi tính min và max ta sẽ kiểm tra
            // nếu min < 1 thì ta sẽ gán min = 1  và max bằng luôn range
            if (self::getInstance()->_config['min'] < 1) {
                self::getInstance()->_config['min'] = 1;
                self::getInstance()->_config['max'] = self::getInstance()->_config['range'];
            }

            // Ngược lại nếu min > tổng số trang
            // ta gán max = tổng số trang và min = (tổng số trang - range) + 1
            else if (self::getInstance()->_config['max'] > self::getInstance()->_config['total_page']) {
                self::getInstance()->_config['max'] = self::getInstance()->_config['total_page'];
                self::getInstance()->_config['min'] = self::getInstance()->_config['total_page'] - self::getInstance()->_config['range'] + 1;
            }
        }

        return self::getInstance();
    }

    /*
     * Hàm lấy link theo trang
     */
    private function __link($page)
    {
        // Nếu trang < 1 thì ta sẽ lấy link first
        if ($page <= 1 && $this->_config['link_first']) {
            return $this->_config['link_first'];
        }
        // Ngược lại ta lấy link_full
        // Như tôi comment ở trên, link full có dạng domain.com/page/{page}.
        // Trong đó {page} là nơi bạn muốn số trang sẽ thay thế vào

        return str_replace('{page}', $page, $this->_config['link_full']);
    }

    public function html()
    {
        $p = '';
        if ($this->_config['total_record'] > $this->_config['limit']) {
            $p = '<ul>';
            // Nút prev và first
            if ($this->_config['current_page'] > 1) {
                $p .= '<li><a href="' . $this->__link('1') . '">&laquo;</a></li>';
                $p .= '<li><a href="' . $this->__link($this->_config['current_page'] - 1) . '">&lsaquo;</a></li>';
            }

            // lặp trong khoảng cách giữa min và max để hiển thị các nút
            for ($i = $this->_config['min']; $i <= $this->_config['max']; $i++) {
                // Trang hiện tại
                if ($this->_config['current_page'] == $i) {
                    $p .= '<li class="active">' . $i . '</li>';
                } else {
                    $p .= '<li><a href="' . $this->__link($i) . '">' . $i . '</a></li>';
                }
            }

            // Nút last và next
            if ($this->_config['current_page'] < $this->_config['total_page']) {
                $p .= '<li><a href="' . $this->__link($this->_config['current_page'] + 1) . '">&rsaquo;</a></li>';
                $p .= '<li><a href="' . $this->__link($this->_config['total_page']) . '">&raquo;</a></li>';
            }

            $p .= '</ul>';
        }

        return '<div class="pagenavi">' . $p . '</div>';
    }
}
