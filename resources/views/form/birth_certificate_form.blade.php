<x-page-layout>
    <div class="bg-white page-content">
        <form class="contact-bx" method="POST" enctype="multipart/form-data" action="">
            @csrf

            <!-- Top Section -->
            <div class="container">
                <h4 class="mb-4 text-center">जनमको सूचना फारम</h4>

                <!-- Child Details -->
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="mb-3">१. नवजात शिशुको जानकारी</h6>

                        <div class="row">
                            <div class="col-md-4">
                                <label>पहिलो नाम (नेपाली)</label>
                                <input type="text" name="n_first_name" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label>बीचको नाम (नेपाली)</label>
                                <input type="text" name="n_middle_name" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>थर (नेपाली)</label>
                                <input type="text" name="n_surname" class="form-control" required>
                            </div>
                        </div>

                        <div class="mt-3 row">
                            <div class="col-md-4">
                                <label>First Name (English)</label>
                                <input type="text" name="e_first_name" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label>Middle Name (English)</label>
                                <input type="text" name="e_middle_name" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>Surname (English)</label>
                                <input type="text" name="e_surname" class="form-control" required>
                            </div>
                        </div>

                        <div class="mt-3 row">
                            <div class="col-md-4">
                                <label>जन्म मिति</label>
                                <input type="date" name="birth_date" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label>लिङ्ग</label>
                                <select name="gender" class="form-control" required>
                                    <option value="male">पुरुष</option>
                                    <option value="female">महिला</option>
                                    <option value="other">अन्य</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>जन्म प्रकार</label>
                                <select name="birth_type" class="form-control" required>
                                    <option value="single">एकल</option>
                                    <option value="twins">जुन्डा</option>
                                    <option value="tripletsOrMore">त्रिगुणित वा अधिक</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-3 row">
                            <div class="col-md-6">
                                <label>जन्म भएको स्थान</label>
                                <select name="birth_place" class="form-control" required>
                                    <option value="home">घर</option>
                                    <option value="healthpost">स्वास्थ्य चौकी</option>
                                    <option value="hospital">अस्पताल</option>
                                    <option value="other">अन्य</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>जन्म भएको प्रदेश</label>
                                <input type="text" name="birth_province" class="form-control">
                            </div>
                        </div>

                        <div class="mt-3 row">
                            <div class="col-md-6">
                                <label>जन्म भएको नगरपालिका</label>
                                <input type="text" name="birth_municipality" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>वडा</label>
                                <input type="number" name="birth_ward" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Grandfather Details -->
                <h6 class="mt-4">२. हजुरबुबाको विवरण</h6>
                <div class="row">
                    <div class="col-md-4">
                        <label>पहिलो नाम (नेपाली)</label>
                        <input type="text" name="n_grandfather_first_name" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>बीचको नाम (नेपाली)</label>
                        <input type="text" name="n_grandfather_middle_name" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>थर (नेपाली)</label>
                        <input type="text" name="n_grandfather_last_name" class="form-control">
                    </div>
                </div>

                <hr>

                <!-- Father's Details -->
                <h6 class="mt-4">३. बाबुको विवरण</h6>
                <div class="row">
                    <div class="col-md-4">
                        <label>पहिलो नाम (नेपाली)</label>
                        <input type="text" name="n_father_first_name" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>बीचको नाम (नेपाली)</label>
                        <input type="text" name="n_father_middle_name" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>थर (नेपाली)</label>
                        <input type="text" name="n_father_last_name" class="form-control">
                    </div>
                </div>

                <!-- Father's Extra Details -->
                <div class="mt-3 row">
                    <div class="col-md-6">
                        <label>नगरपालिका</label>
                        <input type="text" name="father_municipality" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>वडा</label>
                        <input type="number" name="father_ward" class="form-control">
                    </div>
                </div>

                <hr>

                <!-- Mother's Details -->
                <h6 class="mt-4">४. आमाको विवरण</h6>
                <div class="row">
                    <div class="col-md-4">
                        <label>पहिलो नाम (नेपाली)</label>
                        <input type="text" name="n_mother_first_name" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>बीचको नाम (नेपाली)</label>
                        <input type="text" name="n_mother_middle_name" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>थर (नेपाली)</label>
                        <input type="text" name="n_mother_last_name" class="form-control">
                    </div>
                </div>

                <div class="mt-3 row">
                    <div class="col-md-6">
                        <label>नगरपालिका</label>
                        <input type="text" name="mother_municipality" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>वडा</label>
                        <input type="number" name="mother_ward" class="form-control">
                    </div>
                </div>

                <hr>

                <!-- Submit Section -->
                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">पेश गर्नुहोस्</button>
                </div>
            </div>
        </form>

    </div>
</x-page-layout>
