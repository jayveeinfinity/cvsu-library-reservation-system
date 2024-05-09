<?php
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        IB_View::getView('error.404');
    }
    $conx = new IB_Database();
    $profile = array();
    $name = "";
    $position = "";
    $defaultAvatar = "resources/images/avatars/default.jpg";
    $avatar = $defaultAvatar;
    $rows = $conx->Select("SELECT * FROM `lcc_users` WHERE `id` = :id", ['id' => $id])->First();
    $googleInfo = $conx->Select("SELECT * FROM `google_userinfo` WHERE `gu_id` IN (SELECT `gu_id` FROM `lcc_users` WHERE `id` = :in_id)", ['in_id' => $id])->First();
    if(!is_null($rows['profile'])) {
        $profile = IB_Profile::Read($rows['profile']);
    }
    if(count($profile) > 0) {
        $name = $profile['first_name'] . ' ' . $profile['middle_name'] . ' ' . $profile['last_name'];
        $position = IB_Profile::PositionToLabel($profile['position']);
        $avatar = is_null($profile['avatar']) ? $defaultAvatar : $profile['avatar'];
    }
    if($googleInfo) {
        $name = empty($name) ? $googleInfo['gu_name'] : $name;
        $avatar = $avatar == $defaultAvatar ? $googleInfo['gu_picture'] : $avatar;
    } else {
        $name = $rows['email'];
        $position = '---';
        $avatar = $defaultAvatar;
    }
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="?">Home</a></li>
                        <li class="breadcrumb-item"><a href="?parent=users&action=browse">Users</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?php echo $avatar;?>" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center"><?php echo $name;?></h3>
                            <p class="text-muted text-center"><?php echo $position;?></p>
                            <!-- <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Followers</b> <a class="float-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Following</b> <a class="float-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b> <a class="float-right">13,287</a>
                                </li>
                            </ul>
                            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                        </div>
                    </div>
                    <!-- <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Education</strong>

                            <p class="text-muted">
                            B.S. in Computer Science from the University of Tennessee at Knoxville
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                            <p class="text-muted">Malibu, California</p>

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                            <p class="text-muted">
                            <span class="tag tag-danger">UI Design</span>
                            <span class="tag tag-success">Coding</span>
                            <span class="tag tag-info">Javascript</span>
                            <span class="tag tag-warning">PHP</span>
                            <span class="tag tag-primary">Node.js</span>
                            </p>

                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                        </div>
                    </div> -->
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#dashboard" data-toggle="tab">Dashboard</a></li>
                            <!-- <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li> -->
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="dashboard">
                                    <h5 class="mb-3">Dashboard</h5>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="info-box bg-gradient-info">
                                                <span class="info-box-icon"><i class="fas fa-book"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">E-books open access</span>
                                                    <span class="info-box-number">
                                                        <?php
                                                            $conx = new IB_Database();
                                                            echo number_format($conx->Select("SELECT * FROM `ebook_open_access` WHERE `encoded_by` = :in_id", ['in_id' => $id])->Count());
                                                        ?>
                                                    </span>
                                                    <?php
                                                        $totalCount = $conx->Select("SELECT COUNT(*) `COUNT`, MONTH(`created_at`) `MONTH` FROM `ebook_open_access` WHERE MONTH(`created_at`) = (SELECT MONTH(`created_at`) FROM `ebook_open_access` ORDER BY `created_at` DESC LIMIT 1) AND `encoded_by` = :in_id", ['in_id' => $id]);
                                                        $results = $conx->SelectOne("SELECT COUNT(*) `COUNT`, MONTH(NOW()) `MONTH` FROM `ebook_open_access` WHERE MONTH(`created_at`) = MONTH(NOW()) AND `encoded_by` = :in_id", ['in_id' => $id]);
                                                        if($results->Count() > 0) {
                                                            $phrase = $results->Get()['COUNT'] > 0 ? '+' . $results->Get()['COUNT'] . ' since ' . $month : 'No added record';
                                                            $month  = $results->Get()['MONTH'];
                                                            $month = date('F', mktime(0, 0, 0, $month, 10)); // March
                                                            echo ' <div class="progress"><div class="progress-bar" style="width: ' . ($results->Get()['COUNT']/$totalCount->Count() * 100) . '%"></div></div>';
                                                            echo '<span class="progress-description">' . $phrase . '</span>';
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="info-box bg-gradient-success">
                                                <span class="info-box-icon"><i class="fas fa-book"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">E-book purchased</span>
                                                    <span class="info-box-number">
                                                        <?php
                                                            $conx = new IB_Database();
                                                            echo number_format($conx->Select("SELECT * FROM `ebook_purchased` WHERE `encoded_by` = :in_id", ['in_id' => $id])->Count());
                                                        ?>
                                                    </span>
                                                    <?php
                                                        $totalCount = $conx->Select("SELECT COUNT(*) `COUNT`, MONTH(`created_at`) `MONTH` FROM `ebook_purchased` WHERE MONTH(`created_at`) = (SELECT MONTH(`created_at`) FROM `ebook_purchased` ORDER BY `created_at` DESC LIMIT 1) AND `encoded_by` = :in_id", ['in_id' => $id]);
                                                        $results = $conx->SelectOne("SELECT COUNT(*) `COUNT`, MONTH(NOW()) `MONTH` FROM `ebook_purchased` WHERE MONTH(`created_at`) = MONTH(NOW()) AND `encoded_by` = :in_id", ['in_id' => $id]);
                                                        if($results->Count() > 0) {
                                                            $phrase = $results->Get()['COUNT'] > 0 ? '+' . $results->Get()['COUNT'] . ' since ' . $month : 'No added record';
                                                            $month  = $results->Get()['MONTH'];
                                                            $month = date('F', mktime(0, 0, 0, $month, 10)); // March
                                                            echo ' <div class="progress"><div class="progress-bar" style="width: ' . ($results->Get()['COUNT']/$totalCount->Count() * 100) . '%"></div></div>';
                                                            echo '<span class="progress-description">' . $phrase . '</span>';
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="info-box bg-gradient-warning">
                                                <span class="info-box-icon"><i class="fas fa-book"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">E-journal open access</span>
                                                    <span class="info-box-number">
                                                        <?php
                                                            $conx = new IB_Database();
                                                            echo number_format($conx->Select("SELECT * FROM `ejournal_open_access` WHERE `encoded_by` = :in_id", ['in_id' => $id])->Count());
                                                        ?>
                                                    </span>
                                                    <?php
                                                        $totalCount = $conx->Select("SELECT COUNT(*) `COUNT`, MONTH(`created_at`) `MONTH` FROM `ejournal_open_access` WHERE MONTH(`created_at`) = (SELECT MONTH(`created_at`) FROM `ejournal_open_access` ORDER BY `created_at` DESC LIMIT 1) AND `encoded_by` = :in_id", ['in_id' => $id]);
                                                        $results = $conx->SelectOne("SELECT COUNT(*) `COUNT`, MONTH(NOW()) `MONTH` FROM `ejournal_open_access` WHERE MONTH(`created_at`) = MONTH(NOW()) AND `encoded_by` = :in_id", ['in_id' => $id]);
                                                        if($results->Count() > 0) {
                                                            $phrase = $results->Get()['COUNT'] > 0 ? '+' . $results->Get()['COUNT'] . ' since ' . $month : 'No added record';
                                                            $month  = $results->Get()['MONTH'];
                                                            $month = date('F', mktime(0, 0, 0, $month, 10)); // March
                                                            echo ' <div class="progress"><div class="progress-bar" style="width: ' . ($results->Get()['COUNT']/$totalCount->Count() * 100) . '%"></div></div>';
                                                            echo '<span class="progress-description">' . $phrase . '</span>';
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-3 col-sm-6 col-12">
                                            <div class="info-box bg-gradient-danger">
                                                <span class="info-box-icon"><i class="fas fa-comments"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Comments</span>
                                                    <span class="info-box-number">41,410</span>

                                                    <div class="progress">
                                                    <div class="progress-bar" style="width: 70%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                    70% Increase in 30 Days
                                                    </span>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="tab-pane" id="activity">
                                    <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="<?php echo $avatar;?>" alt="user image">
                                        <span class="username">
                                        <a href="#">Jonathan Burke Jr.</a>
                                        <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description">Shared publicly - 7:30 PM today</span>
                                    </div>
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore the hate as they create awesome
                                        tools to help create filler text for everyone from bacon lovers
                                        to Charlie Sheen fans.
                                    </p>

                                    <p>
                                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                        <span class="float-right">
                                        <a href="#" class="link-black text-sm">
                                            <i class="far fa-comments mr-1"></i> Comments (5)
                                        </a>
                                        </span>
                                    </p>

                                    <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                                    </div>
                                    <div class="post clearfix">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="<?php echo $avatar;?>" alt="User Image">
                                        <span class="username">
                                        <a href="#">Sarah Ross</a>
                                        <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description">Sent you a message - 3 days ago</span>
                                    </div>
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore the hate as they create awesome
                                        tools to help create filler text for everyone from bacon lovers
                                        to Charlie Sheen fans.
                                    </p>

                                    <form class="form-horizontal">
                                        <div class="input-group input-group-sm mb-0">
                                        <input class="form-control form-control-sm" placeholder="Response">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-danger">Send</button>
                                        </div>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="<?php echo $avatar;?>" alt="User Image">
                                        <span class="username">
                                        <a href="#">Adam Jones</a>
                                        <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description">Posted 5 photos - 5 days ago</span>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                        <img class="img-fluid" src="<?php echo $avatar;?>" alt="Photo">
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-6">
                                            <img class="img-fluid mb-3" src="<?php echo $avatar;?>" alt="Photo">
                                            <img class="img-fluid" src="<?php echo $avatar;?>" alt="Photo">
                                            </div>
                                            <div class="col-sm-6">
                                            <img class="img-fluid mb-3" src="<?php echo $avatar;?>" alt="Photo">
                                            <img class="img-fluid" src="<?php echo $avatar;?>" alt="Photo">
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <p>
                                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                        <span class="float-right">
                                        <a href="#" class="link-black text-sm">
                                            <i class="far fa-comments mr-1"></i> Comments (5)
                                        </a>
                                        </span>
                                    </p>
                                    <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                                    </div>
                                </div>
                                <div class="tab-pane" id="timeline">
                                    <div class="timeline timeline-inverse">
                                    <div class="time-label">
                                        <span class="bg-danger">
                                        10 Feb. 2014
                                        </span>
                                    </div>
                                    <div>
                                        <i class="fas fa-envelope bg-primary"></i>

                                        <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                        <div class="timeline-body">
                                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                            quora plaxo ideeli hulu weebly balihoo...
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                        </div>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-user bg-info"></i>

                                        <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                        <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                                        </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-comments bg-warning"></i>

                                        <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                        <div class="timeline-body">
                                            Take me to your leader!
                                            Switzerland is small and neutral!
                                            We are more like Germany, ambitious and misunderstood!
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="time-label">
                                        <span class="bg-success">
                                        3 Jan. 2014
                                        </span>
                                    </div>
                                    <div>
                                        <i class="fas fa-camera bg-purple"></i>

                                        <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                        <div class="timeline-body">
                                            <img src="https://placehold.it/150x100" alt="...">
                                            <img src="https://placehold.it/150x100" alt="...">
                                            <img src="https://placehold.it/150x100" alt="...">
                                            <img src="https://placehold.it/150x100" alt="...">
                                        </div>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputName" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName2" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                        <div class="col-sm-10">
                                        <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                            <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                            </label>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>