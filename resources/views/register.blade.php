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
                        <p>Login Your Account <a href="{{ route('filament.user.auth.login') }}">Click here</a></p>
                    </div>
                    <form class="contact-bx" method="POST" enctype="multipart/form-data"
                        action="{{ route('userRegistration') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Your Name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="Your Email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Citizenship Number -->
                                <div class="mb-3">
                                    <label for="citizenshipNo" class="form-label">Citizenship Number</label>
                                    <input type="text" id="citizenshipNo" name="citizenship_no" class="form-control"
                                        placeholder="Citizenship Number" value="{{ old('citizenship_no') }}" required>
                                    @error('citizenship_no')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Citizenship Front Image -->
                                <div class="mb-3 file-upload">
                                    <input type="file" name="citizenship_front_image" id="citizenshipFrontImage"
                                        accept="image/*" required>
                                    <label for="citizenshipFrontImage" style="color:#6c757d;" id="frontLabel">
                                        Choose Front Image or drop here
                                    </label>
                                    <div class="mt-2 progress" id="frontProgress" style="display: none; height: 5px;">
                                        <div class="progress-bar" id="frontProgressBar" role="progressbar"
                                            style="width: 0%;"></div>
                                    </div>
                                    <div class="mt-2 text-success" id="frontSuccessMessage" style="display: none;">
                                    </div>
                                    @error('citizenship_front_image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Address -->
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" id="address" name="address" class="form-control"
                                        placeholder="Address" value="{{ old('address') }}" required>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Date of Birth -->
                                <div class="mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" id="dob" name="dob" class="form-control"
                                        value="{{ old('dob') }}" required>
                                    @error('dob')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Gender -->
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select id="gender" name="gender" class="form-control" required>
                                        <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select
                                            Gender</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Citizenship Back Image -->
                                <div class="mb-3 file-upload">
                                    <input type="file" name="citizenship_back_image" id="citizenshipBackImage"
                                        accept="image/*" required>
                                    <label for="citizenshipBackImage" style="color:#6c757d;" id="backLabel">
                                        Choose Back Image or drop here
                                    </label>
                                    <div class="mt-2 progress" id="backProgress" style="display: none; height: 5px;">
                                        <div class="progress-bar" id="backProgressBar" role="progressbar"
                                            style="width: 0%;"></div>
                                    </div>
                                    <div class="mt-2 text-success" id="backSuccessMessage" style="display: none;">
                                    </div>
                                    @error('citizenship_back_image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-lg-12">
                            <div class="row align-items-end form-group m-b30">
                                <div class="text-left col">
                                    <button name="submit" type="submit" value="Submit" class="btn btn-md"
                                        style="width: 20%; height:50px; font-size:1rem; font-weight: 500">
                                        Sign Up
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function handleFileUpload(input, progressBar, progressDiv, label, successMessage) {
                input.addEventListener('change', () => {
                    const file = input.files[0];
                    if (file) {
                        // Reset states
                        successMessage.style.display = 'none';
                        progressDiv.style.display = 'block';
                        progressBar.style.width = '0%';

                        // Simulate file upload progress
                        let progress = 0;
                        const interval = setInterval(() => {
                            progress += 10;
                            progressBar.style.width = `${progress}%`;

                            if (progress >= 100) {
                                clearInterval(interval);

                                // Display success message
                                progressDiv.style.display = 'none';
                                successMessage.style.display = 'block';
                                successMessage.textContent = `Uploaded: ${file.name}`;
                                label.style.color = 'green';
                            }
                        }, 200); // Simulates 2 seconds for upload
                    }
                });
            }

            const citizenshipFrontInput = document.getElementById('citizenshipFrontImage');
            const citizenshipBackInput = document.getElementById('citizenshipBackImage');

            const frontProgressBar = document.getElementById('frontProgressBar');
            const backProgressBar = document.getElementById('backProgressBar');

            const frontProgressDiv = document.getElementById('frontProgress');
            const backProgressDiv = document.getElementById('backProgress');

            const frontLabel = document.getElementById('frontLabel');
            const backLabel = document.getElementById('backLabel');

            const frontSuccessMessage = document.getElementById('frontSuccessMessage');
            const backSuccessMessage = document.getElementById('backSuccessMessage');

            handleFileUpload(citizenshipFrontInput, frontProgressBar, frontProgressDiv, frontLabel,
                frontSuccessMessage);
            handleFileUpload(citizenshipBackInput, backProgressBar, backProgressDiv, backLabel, backSuccessMessage);
        });
    </script>

</x-register-layout>
