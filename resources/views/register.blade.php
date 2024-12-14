<x-register-layout>
    <div class="page-wraper">
        <div id="loading-icon-bx"></div>
        <div class="account-form">
            <div class="account-head" style="background-image:url(assets/images/background/bg2.jpg);">
                <a href="index.html"><img src="assets/images/logo-white-2.png" alt=""></a>
            </div>
            <div class="account-form-inner" style="padding: 0">
                <div class="account-container">
                    <div class="heading-bx left">
                        <h2 class="title-head">Sign Up <span>Now</span></h2>
                        <p>Login Your Account <a href="{{ route('login') }}">Click here</a></p>
                    </div>
                    <form class="contact-bx" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Your Name" required>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="Your Email" required>
                                </div>

                                <!-- Citizenship Number -->
                                <div class="mb-3">
                                    <label for="citizenshipNo" class="form-label">Citizenship Number</label>
                                    <input type="text" id="citizenshipNo" name="citizenship_no" class="form-control"
                                        placeholder="Citizenship Number" required>
                                </div>

                                {{-- <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="Password" required>
                                </div>

                                <!-- Re-enter Password -->
                                <div class="mb-3">
                                    <label for="repassword" class="form-label">Re-enter Password</label>
                                    <input type="password" id="repassword" name="repassword" class="form-control"
                                        placeholder="Re-enter Password" required>
                                </div> --}}

                                <!-- Citizenship Front Image -->
                                <div class="mb-3 file-upload">
                                    {{-- <label for="citizenshipFrontImage" class="form-label">Citizenship Front
                                            Image</label> --}}
                                    <input type="file" name="citizenship_front_image" id="citizenshipFrontImage"
                                        accept="image/*" required>
                                    <label for="citizenshipFrontImage" style="color:#6c757d;">Choose
                                        Front Image or
                                        drop here</label>
                                </div>
                            </div>

                            <div class="col-md-6">



                                {{-- <!-- Ward Number -->
                                    <div class="mb-3">
                                        <label for="wardNo" class="form-label">Ward Number (Default: 10)</label>
                                        <input type="number" id="wardNo" name="ward_no" class="form-control"
                                            placeholder="Ward Number (Default: 10)" value="10" required>
                                    </div> --}}

                                <!-- Address -->
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" id="address" name="address" class="form-control"
                                        placeholder="Address" required>
                                </div>

                                <!-- Date of Birth -->
                                <div class="mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" id="dob" name="dob" class="form-control" required>
                                </div>

                                <!-- Gender -->
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select id="gender" name="gender" class="form-control" required>
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <!-- Citizenship Back Image -->
                                <div class="mb-3 file-upload">
                                    {{-- <label for="citizenshipBackImage" class="form-label">Citizenship Back
                                            Image</label> --}}
                                    <input type="file" name="citizenship_back_image" id="citizenshipBackImage"
                                        accept="image/*" required>
                                    <label for="citizenshipBackImage" style="color:#6c757d;">Choose
                                        Back Image or drop
                                        here</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="row align-items-end form-group m-b30">
                                <div class="text-left col">
                                    <button name="submit" type="submit" value="Submit" class="btn btn-md"
                                        style="width: 60%; height:50px; font-size:1rem; font-weight: 500">Sign
                                        Up</button>
                                </div>

                                <div class="col">
                                    {{-- <h6>Sign Up with Social media</h6>
                                    <div class="d-flex">
                                        <a class="btn m-r5 facebook" style="width: 60%;" href="#"><i
                                                class="fa fa-google"></i>Google</a>
                                    </div> --}}
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
            </form>
        </div>
    </div>

</x-register-layout>
