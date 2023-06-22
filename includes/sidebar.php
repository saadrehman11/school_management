<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <!-- <li class="nav-item">
    <a class="nav-link " href="../dashboard/dashboard.php">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li> -->
  <!-- End Dashboard Nav -->


  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#students-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-person"></i><span>Students</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="students-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="../students/students.php">
          <i class="bi bi-circle"></i><span>All Students</span>
        </a>
      </li>
      <li>
        <a href="../students/add_student.php">
          <i class="bi bi-circle"></i><span>Add Student</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#hoa-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Head Of Accounts</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="hoa-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="../head_of_accounts/all_head_of_accounts.php">
          <i class="bi bi-circle"></i><span>All Head Of Accounts</span>
        </a>
      </li>
      <li>
        <a href="../head_of_accounts/add_head_of_accounts.php">
          <i class="bi bi-circle"></i><span>Add Head Of Accounts</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#fee-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Fee Details</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="fee-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a class="nav-link collapsed" href="../fee_details/all_fee_details.php">
          <i class="bi bi-journal-text"></i><span>All Fee Details</span>
        </a>
      </li>
      <li>
        <a href="../fee_details/outstanding_fee.php">
          <i class="bi bi-circle"></i><span>Outstanding Fee</span>
        </a>
        <a href="../fee_details/paid_fee.php">
          <i class="bi bi-circle"></i><span>Paid Fee</span>
        </a>
      </li>
    </ul>
    
  </li>
  <li class="nav-item">
    <a class="nav-link " href="../statistics/statistics.php">
      <i class="bi bi-grid"></i>
      <span>Statistics</span>
    </a>
  </li>
  <!-- <li class="nav-item">
    <a class="nav-link " href="../import_data/import_data.php">
      <i class="bi bi-grid"></i>
      <span>Import Data</span>
    </a>
  </li> -->
 


</ul>

</aside><!-- End Sidebar-->
