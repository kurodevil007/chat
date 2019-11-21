<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WebChat</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/custom.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/PACE/pace.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/PACE/themes/green/pace-theme-barber-shop.css') ?>">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">WebChat</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Chat <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="messaging mt-2">
            <div class="inbox_msg">
                <div class="inbox_people">
                    <div class="headind_srch">
                        <div class="recent_heading">
                            <h4>Recent</h4>
                        </div>
                        <div class="srch_bar">
                            <div class="stylish-input-group">
                                <input type="text" class="search-bar" placeholder="Search">
                                <span class="input-group-addon">
                                    <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                                </span> </div>
                        </div>
                    </div>
                    <div class="inbox_chat">
                        <?php
                        foreach ($friend_list as $fl) { ?>
                            <div class="chat_list">
                                <button class="btn btn-block" data-id="<?php echo $fl[0]->username ?>" id="chat_from">
                                    <div class="chat_people">
                                        <div class="chat_img"> <img src="<?php echo base_url('userfiles/avatar.jpg') ?>"> </div>
                                        <div class="chat_ib">
                                            <h5><?php echo ($fl[0]->nama); ?> <span class="chat_date">Dec 25</span></h5>
                                            <p>append chat terakhir disini.</p>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
                <div class="mesgs">
                    <div class="msg_history">
                        <?php
                        foreach ($chat as $key) {
                            if ($key['dari'] == 'ihsanfawzan') { ?>
                                <div class="outgoing_msg">
                                    <div class="sent_msg">
                                        <p><?php echo $key['pesan'] ?></p>
                                        <span class="time_date"> <?php echo $key['created_at'] ?></span>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="incoming_msg">
                                    <div class="incoming_msg_img"> <img src="<?php echo base_url('userfiles/avatar.jpg') ?>"> </div>
                                    <div class="received_msg">
                                        <div class="received_withd_msg">
                                            <p><?php echo $key['pesan'] ?></p>
                                            <span class="time_date"> <?php echo $key['created_at'] ?></span>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        }
                        ?>
                    </div>
                    <div class="type_msg">
                        <form action="javascript:void(0)" method="post" id="pesanslur">
                            <input type="hidden" name="dari" value="<?php // echo $this->session->username 
                                                                    ?>">
                            <input type="hidden" name="ke" value="">
                            <div class="input_msg_write">
                                <input type="text" class="write_msg" placeholder="Ketik pesan" name="pesan">
                                <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body text-center">
                @sinergi.unsil
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/PACE/pace.min.js') ?>"></script>
    <script>
        $(document).ready(function() {
            $('#pesanslur').submit(function() {
                $.ajax({
                    "url": "<?php echo site_url('api/chat') ?>",
                    "type": "POST",
                    "data": $(this).serialize(),
                    success: function(data) {
                        location.reload(false);
                        window.scrollTo(0, document.querySelector('.msg_history').scrollHeight);
                    }
                })
            });
        });
    </script>
</body>

</html>