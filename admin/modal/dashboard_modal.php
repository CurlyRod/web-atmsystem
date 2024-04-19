<!-- Modal -->
<div class="modal fade" id="add-user-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ">
            <div class="modal-header border-bottom ">
                <img src="../shared/images/add-user.png" class="btn-add" alt="add-user">
                <h1 class=" modal-title fs-5 mt-2">Register User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <form method="POST" action="" id="signupForm">
                    <div class="row mb-2 form-item">
                        <div class="col">
                            <label class="form-label">Student Number</label>
                            <input type="text" class="form-control" id="student_number" name="student_number">
                        </div>
                        <div class="col">
                            <label class="form-label">Section</label>
                            <select class="form-select form-select" id="section" name="section" >
                                <option selected> Choose Section</option>
                                <?php  
                                                    foreach($allSection as $option)
                                                    {
                                                        ?><option value="<?php echo $option['id']; ?>">
                                    <?php echo $option['section']; ?> </option><?php
                                                    }
                                                 ?>
                            </select>
                            <p class="error-msg  d-none" id="error-msg" style="color:rgb(184, 17, 17)">Section is
                                required </p>
                        </div>
                    </div>
                    <div class="row mb-2 form-item">
                        <div class="col">
                            <label class="form-label">FirstName</label>
                            <input type="text" class="form-control" id="fname" name="fname">
                            <p class="error-msg  d-none" id="error-msg" style="color:rgb(184, 17, 17)">field is
                                required </p>
                        </div>
                        <div class="col">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="mname" name="mname">
                        </div>
                    </div>
                    <div class="row mb-2 form-item">
                        <div class="col">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname">
                        </div>
                        <div class="col">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" id="email">
                        </div>
                    </div>
                    <div class="row form-item">
                        <div class="col">
                            <div class="mb-2">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">

                            </div>
                        </div>
                    </div>
                    <div class="container-btn text-center">
                        <button type="submit" name="registerUser" id="registerUser"
                            class="btn btn-dark mb-2 mt-2">Register</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- UPDATE MODAL -->

<div class="modal fade" id="edit-user-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ">
            <div class="modal-header border-bottom ">
                <img src="../shared/images/note.png" class="btn-add" alt="add-user">
                <h1 class=" modal-title fs-5 mt-2">Edit User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <form method="POST" action="" id="editUserForm" novalidate onsubmit=" return checkforblank()">
                    <input type="hidden" id="edit_user_Id" name="edit_user_Id">
                    <div class="row mb-2 form-item">
                        <div class="col">
                            <label class="form-label">Student Number</label>
                            <input type="text" class="form-control" id="edit_student_number" name="edit_student_number">
                        </div>
                        <div class="col">
                            <label class="form-label">Section</label>
                            <select class="form-select form-select" id="edit_section" name="edit_section" onchange="checkforblank()">
                                <option value ="1" selected> Choose Section</option>
                                <?php  
                                 foreach($allSection as $option)
                                     {
                                 ?><option value="<?php echo $option['id']; ?>">
                                <?php echo $option['section']; ?> </option><?php
                                     }
                                ?>
                            </select>
                            <p class="error-msg  d-none" id="error-msg" style="color:rgb(184, 17, 17)">Section is
                                required </p>
                        </div>
                    </div>
                    <div class="row mb-2 form-item">
                        <div class="col">
                            <label class="form-label">FirstName</label>
                            <input type="text" class="form-control" name="edit_fname" id="edit_fname">
                            <p class="error-msg  d-none" id="error-msg" style="color:rgb(184, 17, 17)">field is
                                required </p>
                        </div>
                        <div class="col">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control"  id="edit_mname" name="edit_mname">
                        </div>
                    </div>
                    <div class="row mb-2 form-item">
                        <div class="col">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="edit_lname"  name="edit_lname">
                        </div>
                        <div class="col">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" id="edit_email" name="edit_email">
                        </div>
                    </div>

                    <div class="container-btn text-center">
                        <button type="submit" name="editUser" id="editUser"
                            class="btn btn-warning mb-2 mt-2">Update</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div> 
 
<!-- VIEW -->

<div class="modal fade" id="view-user-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ">
            <div class="modal-header border-bottom ">
                <img src="../shared/images/vision.png" class="btn-add" alt="add-user">
                <h1 class=" modal-title fs-5 mt-2">View User Information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form   id="viewUserForm" " > 
                <fieldset disabled>
                    <div class="row mb-2 form-item">
                        <div class="col ">
                            <label class="form-label">Student Number</label>
                            <input type="text" class="form-control disabled"" id="view_student_number" name="view_student_number">
                        </div> 
                        <div class="col ">
                            <label class="form-label">RFID Tag</label>
                            <input type="text" class="form-control disabled"" id="view_rfid" name="view_rfid" >
                        </div>
                        <div class="col">
                            <div class="col">
                            <label class="form-label">Section</label>
                            <select class="form-select form-select" id="view_section" name="view_section" onchange="checkforblank()">
                                <option selected> Choose Section</option>
                                <?php  
                                 foreach($allSection as $option)
                                     {
                                 ?><option value="<?php echo $option['id']; ?>">
                                <?php echo $option['section']; ?> </option><?php
                                     }
                                ?>
                            </select>
                            <p class="error-msg  d-none" id="error-msg" style="color:rgb(184, 17, 17)">Section is
                                required </p>
                        </div>
                        </div>
                    </div>
                    <div class="row mb-2 form-item">
                        <div class="col">
                            <label class="form-label">FirstName</label>
                            <input type="text" class="form-control" name="view_fname" id="view_fname">
                        </div>
                        <div class="col">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control"  id="view_mname" name="view_mname">
                        </div>
                    </div>
                    <div class="row mb-2 form-item">
                        <div class="col">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="view_lname"  name="view_lname">
                        </div>
                        <div class="col">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" id="view_email" name="view_email">
                        </div>
                    </div>
                          </div>
                          </fieldset>   
            </form>
        </div>
    </div>
</div>
</div>