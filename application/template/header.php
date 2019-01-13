<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Up2Date</title>

        <!-- The Bootstrap CSS file -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.min.css">

        <!-- FontAwesome Icons -->
        <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" integrity="sha384-kW+oWsYx3YpxvjtZjFXqazFpA7UP/MbiY4jvs+RWZo2+N94PFZ36T6TFkc9O3qoB" crossorigin="anonymous"></script>
    </head>
    <body>
        <aside id="sidebar" class="collapse d-block">
            <header class="navbar navbar-light align-items-stretch">
                <img src="/images/up2date.png" alt="Up2Date">
            </header>

            <nav id="sidebar-nav">
                <ul class="nav flex-column">
<?php if ($_COOKIE['role_id'] == 2): ?>
                  <li class="nav-item dropright">
                      <a href="profile.php" class="nav-link">
                          <i class="icon fas fa-user"></i>
                          <span>Profile</span>
                      </a>
                  </li>
                  <li class="nav-item dropright">
                      <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="icon fas fa-newspaper"></i>
                          <span>Assignments</span>
                      </a>
                      <div class="dropdown-menu">
                          <ul class="nav">
                              <li class="nav-item">
                                  <a href="assignments-list.php" class="nav-link">
                                      <i class="icon fas fa-bars"></i>
                                      <span>View Assignments</span>
                                  </a>
                              </li>
                          </ul>
                          <ul class="nav">
                              <li class="nav-item">
                                  <a href="assignments-add.php" class="nav-link">
                                      <i class="icon fas fa-plus"></i>
                                      <span>Add Assignment</span>
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </li>
                  <li class="nav-item dropright">
                      <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="icon fas fa-newspaper"></i>
                          <span>Attendance</span>
                      </a>
                      <div class="dropdown-menu">
                          <ul class="nav">
                              <li class="nav-item">
                                  <a href="attendance-list.php" class="nav-link">
                                      <i class="icon fas fa-bars"></i>
                                      <span>View Attendance</span>
                                  </a>
                              </li>
                          </ul>
                          <ul class="nav">
                              <li class="nav-item">
                                  <a href="attendance-add.php" class="nav-link">
                                      <i class="icon fas fa-plus"></i>
                                      <span>Update Attendance</span>
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </li>
<?php endif; ?>
<?php if ($_COOKIE['role_id'] == 1): ?>
                  <li class="nav-item dropright">
                    <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon fas fa-id-card"></i>
                      <span>Students</span>
                    </a>
                    <div class="dropdown-menu">
                        <ul class="nav">
                            <li class="nav-item">
                                <a href="students-list.php" class="nav-link">
                                    <i class="icon fas fa-bars"></i>
                                    <span>View Students</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                  </li>
                  <li class="nav-item dropright">
                    <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon fas fa-book"></i>
                        <span>Subjects</span>
                    </a>
                    <div class="dropdown-menu">
                      <ul class="nav">
                          <li class="nav-item">
                              <a href="subjects-list.php" class="nav-link">
                                  <i class="icon fas fa-bars"></i>
                                  <span>View Subjects</span>
                              </a>
                          </li>
                      </ul>
                      <ul class="nav">
                        <li class="nav-item">
                          <a href="subjects-add.php" class="nav-link">
                            <i class="icon fas fa-plus"></i>
                              <span>Add Subject</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item dropright">
                    <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon fas fa-calendar"></i>
                        <span>Timetable</span>
                    </a>
                    <div class="dropdown-menu">
                      <ul class="nav">
                          <li class="nav-item">
                              <a href="timetables-list.php" class="nav-link">
                                  <i class="icon fas fa-bars"></i>
                                  <span>View Timetables</span>
                              </a>
                          </li>
                      </ul>
                      <ul class="nav">
                        <li class="nav-item">
                          <a href="timetables-add.php" class="nav-link">
                            <i class="icon fas fa-plus"></i>
                              <span>Add Timetable</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item dropright">
                    <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon fas fa-graduation-cap"></i>
                        <span>Courses</span>
                    </a>
                    <div class="dropdown-menu">
                      <ul class="nav">
                          <li class="nav-item">
                              <a href="courses-list.php" class="nav-link">
                                  <i class="icon fas fa-bars"></i>
                                  <span>View Courses</span>
                              </a>
                          </li>
                      </ul>
                      <ul class="nav">
                        <li class="nav-item">
                          <a href="courses-add.php" class="nav-link">
                            <i class="icon fas fa-plus"></i>
                              <span>Add Course</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>
<?php endif; ?>
                  <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                      <i class="icon fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                  </li>
                </ul>
            </nav>
        </aside>

        <div id="content">
            <nav class="navbar navbar-light align-items-stretch">
                <a href="#sidebar" class="toggle-sidebar ml-auto d-block d-md-none border-left" data-toggle="collapse">
                    <i class="icon fas fa-bars"></i>
                </a>
            </nav>

            <div class="container-fluid px-4">
