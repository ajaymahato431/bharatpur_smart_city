<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birth Registration Certificate</title>
    <style>
        * {
            padding: 0px;
            margin: 0px;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .certificate {
            border: 2px solid #000;
            padding: 20px;
            width: 710px;
            margin: 0 auto;
            background: #fff;
        }

        .header {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
            padding-right: 130px
        }

        .header img {
            width: 130px;
        }

        .heading-text {
            text-align: center;
        }

        h1 {
            font-size: 22px;
            margin: 5px 0;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            text-align: left;
            border: 1px solid #000;
            padding: 5px 10px;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            font-weight: bold;
        }

        .stamp {
            text-align: center;
        }

        .stamp div {
            width: 120px;
            height: 50px;
            border: 2px solid black;
            display: inline-block;
        }

        table {
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="certificate">
        <!-- Header -->
        <div class="header">
            <img src="{{ public_path('img/sarkar.png') }}" alt="Nepal Emblem">
            <div class="heading-text">
                <h6>अनुसूची-२०</h6>
                <h6>(नियम २० को उपनियम (१) को खण्ड (क) सँग सम्बन्धित)</h6>
                <h6>नेपाल सरकार (Government of Nepal)</h6>
                <h6>स्थानीय पञ्जिकाधिकारीको कार्यालय (Office of Local Registrar)</h6>
                <h5>वडा नं. १, मध्यविन्दु नगरपालिका</h5>
                <h5>नवलपरासी (बर्दघाट सुस्ता पूर्व) जिल्ला, गण्डकी प्रदेश</h5>
                <h5>Ward No. 1, Madhyabindu Municipality</h5>
                <h5>Nawalparasi (East of Bardaghat Susta) District, Gandaki Province</h5>
            </div>
        </div>

        <!-- Title -->
        <div style="text-align: center; margin-bottom: 20px;">
            <h3>जन्म दर्ता प्रमाणपत्र</h3>
            <h3>Birth Registration Certificate</h3>
        </div>

        <!-- Content -->
        <table>
            <tr>
                <th>दर्ता नम्बर:</th>
                <td>{{ $certificate->serviceRequests->last()->verificationDetails->form_no }}</td>
                <th>Registration No:</th>
                <td>{{ $certificate->serviceRequests->last()->verificationDetails->form_no }}</td>
            </tr>
            <tr>
                <th>दर्ता मिति:</th>
                <td>{{ $certificate->serviceRequests->last()->verificationDetails->form_date }}</td>
                <th>Registration Date:</th>
                <td>{{ $certificate->serviceRequests->last()->verificationDetails->form_date }}</td>
            </tr>
            <tr>
                <th>पूरा नाम:</th>
                <td>{{ $certificate->n_first_name }} {{ $certificate->n_middle_name }} {{ $certificate->n_surname }}
                </td>
                <th>Name (English):</th>
                <td>{{ $certificate->e_first_name }} {{ $certificate->e_middle_name }} {{ $certificate->e_surname }}
                </td>
            </tr>
            <tr>
                <th>जन्म मिति:</th>
                <td>{{ $certificate->birth_date }}</td>
                <th>Birth Date:</th>
                <td>{{ $certificate->birth_date }}</td>
            </tr>
            <tr>
                <th>लिङ्ग/Sex:</th>
                <td colspan="3">{{ $certificate->gender }}</td>
            </tr>
        </table>

        <table>
            <!-- Birth Details -->
            <tr>
                <th colspan="4">जन्म स्थान (Birth Details)</th>
            </tr>
            <tr>
                <td>प्रदेश:</td>
                <td>{{ $certificate->n_birth_province ?? 'N/A' }}</td>

                <td>जिल्ला:</td>
                <td>{{ $certificate->n_birth_district ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>नगरपालिका:</td>
                <td>{{ $certificate->n_birth_municipality ?? 'N/A' }}</td>

                <td>वडा नं.:</td>
                <td>{{ $certificate->n_birth_ward ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Province:</td>
                <td>{{ $certificate->e_birth_province ?? 'N/A' }}</td>

                <td>District:</td>
                <td>{{ $certificate->e_birth_district ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Municipality:</td>
                <td>{{ $certificate->e_birth_municipality ?? 'N/A' }}</td>

                <td>Ward No.:</td>
                <td>{{ $certificate->e_birth_ward ?? 'N/A' }}</td>
            </tr>

            <!-- Permanent Address -->
            <tr>
                <th colspan="4">स्थायी ठेगाना (Permanent Address)</th>
            </tr>
            <tr>
                <td>प्रदेश:</td>
                <td>{{ $certificate->n_permanent_province ?? 'N/A' }}</td>

                <td>जिल्ला:</td>
                <td>{{ $certificate->n_permanent_district ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>नगरपालिका:</td>
                <td>{{ $certificate->n_permanent_municipality ?? 'N/A' }}</td>

                <td>वडा नं.:</td>
                <td>{{ $certificate->n_permanent_ward ?? 'N/A' }}</td>
            </tr>

            <tr>
                <td>Province:</td>
                <td>{{ $certificate->e_permanent_province ?? 'N/A' }}</td>

                <td>District:</td>
                <td>{{ $certificate->e_permanent_district ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Municipality:</td>
                <td>{{ $certificate->e_permanent_municipality ?? 'N/A' }}</td>

                <td>Ward No.:</td>
                <td>{{ $certificate->e_permanent_ward ?? 'N/A' }}</td>
            </tr>

            <!-- Father's Details -->
            <tr>
                <th colspan="4">बाबुको विवरण / Father's Details</th>
            </tr>
            <tr>
                <th>पूरा नाम:</th>
                <td>{{ $certificate->n_father_first_name }} {{ $certificate->n_father_middle_name }}
                    {{ $certificate->n_father_last_name }}</td>

                <th>Full Name:</th>
                <td>{{ $certificate->e_father_first_name }} {{ $certificate->e_father_middle_name }}
                    {{ $certificate->e_father_last_name }}</td>
            </tr>
            <tr>
                <th>नागरिकता प्रमाणपत्र नं. (Citizenship No) :</th>
                <td colspan="3">{{ $certificate->father_citizenship_no }}</td>
            </tr>

            <!-- Mother's Details -->
            <tr>
                <th colspan="4">आमाको विवरण / Mother's Details</th>
            </tr>
            <tr>
                <th>पूरा नाम:</th>
                <td>{{ $certificate->n_mother_first_name }} {{ $certificate->n_mother_middle_name }}
                    {{ $certificate->n_mother_last_name }}</td>

                <th>Full Name:</th>
                <td>{{ $certificate->e_mother_first_name }} {{ $certificate->e_mother_middle_name }}
                    {{ $certificate->e_mother_last_name }}</td>
            </tr>
            <tr>
                <th>नागरिकता प्रमाणपत्र नं. (Citizenship No) :</th>
                <td colspan="3">{{ $certificate->mother_citizenship_no }}</td>
            </tr>

            <!-- Informer's Details -->
            <tr>
                <th colspan="4">सूचकको विवरण / Informant's Details</th>
            </tr>
            <tr>
                <th>पूरा नाम:</th>
                <td>{{ $certificate->n_informer_first_name }} {{ $certificate->n_informer_middle_name }}
                    {{ $certificate->n_informer_last_name }}</td>
                <th>Full Name:</th>
                <td>{{ $certificate->e_informer_first_name }} {{ $certificate->e_informer_middle_name }}
                    {{ $certificate->e_informer_last_name }}</td>
            </tr>
            <tr>
                <th>नागरिकता प्रमाणपत्र नं. (Citizenship No) :</th>
                <td colspan="3">{{ $certificate->informer_citizenship_no }}</td>
            </tr>

        </table>


        <!-- Footer -->
        <div class="footer">
            <div style="font-size: 12px;">
                <p style="margin-bottom: 5px">दस्तखत (Signature): ________________________</p>
                <p style="margin-bottom: 5px">स्थानीय पञ्जिकाधिकारीको नामः
                    {{ $certificate->serviceRequests->last()->verificationDetails->officers->name }} </p>
                <p style="margin-bottom: 5px">Name of Local Registrar:
                    {{ $certificate->serviceRequests->last()->verificationDetails->officers->name }}</p>
            </div>

            <div class="stamp">
                <div></div>
                <p style="font-size: 12px">कार्यालयको छाप / Official Stamp</p>
            </div>
        </div>
    </div>
</body>

</html>
