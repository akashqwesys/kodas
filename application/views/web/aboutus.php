        <!-- Main Content Wrapper Start -->
        <div id="content" class="main-content-wrapper">
            <div class="page-content-inner pt--75">
                <div class="container">
                    <div class="row pb--80">
                        <div class="col-md-12 mb-sm--30">
                            <h2 class="heading__secondary mb--50 mb-md--35 mb-sm--20">About Us</h2>
                            <?php
                            $query = $this->db->get('aboutpage');
                            $result = $query->result_array();
                            $data = [];
                            foreach ($result as $value) { ?>
                            <h3><?php echo $value['title']; ?></h3>
                            <p><?php echo $value['description']; ?></p>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
