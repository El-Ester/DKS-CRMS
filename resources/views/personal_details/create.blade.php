<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/unissalogo.jpg') }}" type="image/jpeg">
    <title>Personal Details</title>
    <link rel="stylesheet" href="{{ asset('css/PersonalDetails.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

@include('components.candidate.header')
@include('components.candidate.sidebar')

<body>
    <section class="home-section bg-lightblue">

        <div class="container py-4">
            <i class='bx bx-menu'></i>

            <h1>Personal Details</h1>

            <hr>
                    <form action="{{ route('personal_details.store') }}" method="POST" class="need-validation" enctype="multipart/form-data" novalidate>
                        @csrf



                        <!-- Name -->
                        <div class="mb-4">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" value="{{ $personalDetail->name ?? $candidate->name ?? '' }}" required readonly>

                                <!-- Identity Card No. -->
                                <label for="identity_card_no">Identity Card No.:</label>
                                <input type="text" id="identity_card_no" name="identity_card_no" value="{{ $personalDetail->identity_card_no ?? '' }}"required>
                            </div>
                        </div>

                        <!-- Date of Issue -->
                        <div class="mb-4">
                            <div class="form-group">
                                <label for="date_of_issue">Date of Issue:</label>
                                <input type="date" id="date_of_issue" name="date_of_issue" value="{{ $personalDetail->date_of_issue ?? '' }}" required>
                            </div>
                        </div>

                        <!-- Date of Birth -->
                        <div class="mb-4">
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth:</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" value="{{ $personalDetail->date_of_birth ?? '' }}" required>

                            <!-- Age -->
                                <label for="age">Age:</label>
                                <input type="number" id="age" name="age" value="{{ $personalDetail->age ?? '' }}" required>
                            </div>
                        </div>

                        <!-- Place of Birth -->
                        <div class="mb-4">
                            <div class="form-group">
                                <label for="place_of_birth">Place of Birth:</label>
                                <input type="text" id="place_of_birth" name="place_of_birth" value="{{ $personalDetail->place_of_birth ?? '' }}" required>
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="mb-4">
                            <div class="form-group">
                                <label for="gender">Gender:</label>
                                <select name="gender" id="gender" required>
                                    <option value="Female" {{ (isset($personalDetail) && $personalDetail->gender == 'Female') ? 'selected' : '' }}>Female</option>
                                    <option value="Male" {{ (isset($personalDetail) && $personalDetail->gender == 'Male') ? 'selected' : '' }}>Male</option>
                                </select>
                            </div>
                        </div>

                        <!-- Marital Status -->
                        <div class="mb-4">
                            <div class="form-group">
                                <!-- Marital Status -->
                                <label for="marital_status">Marital Status:</label>
                                <select id="marital_status" name="marital_status" required>
                                    <option value="select" {{ (isset($personalDetail) && $personalDetail->marital_status == 'select') ? 'selected' : '' }}>--select--</option>
                                    <option value="Single" {{ (isset($personalDetail) && $personalDetail->marital_status == 'Single') ? 'selected' : '' }}>Single</option>
                                    <option value="Married" {{ (isset($personalDetail) && $personalDetail->marital_status == 'Married') ? 'selected' : '' }}>Married</option>
                                    <option value="Others" {{ (isset($personalDetail) && $personalDetail->marital_status == 'Others') ? 'selected' : '' }}>Others</option>
                                </select>

                                <!-- Race -->
                                <label for="race">Race:</label>
                                <select id="race" name="race" required>
                                    <option value="select" {{ (isset($personalDetail) && $personalDetail->race == 'select') ? 'selected' : '' }}>--select--</option>
                                    <option value="Bruneian Malay" {{ (isset($personalDetail) && $personalDetail->race == 'Bruneian Malay') ? 'selected' : '' }}>Bruneian Malay</option>
                                    <option value="Tutong" {{ (isset($personalDetail) && $personalDetail->race == 'Tutong') ? 'selected' : '' }}>Tutong</option>
                                    <option value="Belait" {{ (isset($personalDetail) && $personalDetail->race == 'Belait') ? 'selected' : '' }}>Belait</option>
                                    <option value="Dusun" {{ (isset($personalDetail) && $personalDetail->race == 'Dusun') ? 'selected' : '' }}>Dusun</option>
                                    <option value="Murut" {{ (isset($personalDetail) && $personalDetail->race == 'Murut') ? 'selected' : '' }}>Murut</option>
                                    <option value="Kedayan" {{ (isset($personalDetail) && $personalDetail->race == 'Kedayan') ? 'selected' : '' }}>Kedayan</option>
                                    <option value="Bisaya" {{ (isset($personalDetail) && $personalDetail->race == 'Bisaya') ? 'selected' : '' }}>Bisaya</option>
                                    <option value="Others" {{ (isset($personalDetail) && $personalDetail->race == 'Others') ? 'selected' : '' }}>Others</option>
                                </select>
                            </div>
                        </div>

                        <!-- Religion -->
                        <div class="mb-4">
                            <div class="form-group">
                                <label for="religion">Religion:</label>
                                    <select id="religion" name="religion" value="{{ $personalDetail->religion ?? '' }}" required>
                                        <option value="select" {{ (isset($personalDetail) && $personalDetail->religion == 'select') ? 'selected' : '' }}>--select--</option>
                                        <option value="Muslim" {{ (isset($personalDetail) && $personalDetail->religion == 'Muslim') ? 'selected' : '' }}>Muslim</option>
                                        <option value="Non-Muslim" {{ (isset($personalDetail) && $personalDetail->religion == 'Non-Muslim') ? 'selected' : '' }}>Non-Muslim</option>
                                    </select>

                            <!-- Citizenship -->
                                <label for="citizenship">Citizenship:</label>
                                <input type="text" id="citizenship" name="citizenship" value="{{ $personalDetail->citizenship ?? '' }}" required>
                            </div>
                        </div>

                        <!-- Birth / Citizenship Certificate Number -->
                        <div class="mb-4">
                            <div class="form-group">
                                <label for="certificate_number">Birth / Citizenship Certificate Number:</label>
                                <input type="text" id="certificate_number" name="certificate_number" value="{{ $personalDetail->certificate_number ?? '' }}" required>

                            <!-- Driving Licence -->
                                <label for="driving_licence">Driving Licence (Optional)State Class (1-12):</label>
                                <input type="text" id="driving_licence" name="driving_licence" value="{{ $personalDetail->driving_licence ?? '' }}" >
                            </div>
                        </div>

                        <!-- Tel. House -->
                        <div class="mb-4">
                            <div class="form-group">
                                <label for="tel_house">Tel. House:</label>
                                <input type="text" id="tel_house" name="tel_house" value="{{ $personalDetail->tel_house ?? '' }}" required>

                            <!-- Tel. Mobile -->
                                <label for="tel_mobile">Tel. Mobile:</label>
                                <input type="text" id="tel_mobile" name="tel_mobile" value="{{ $personalDetail->tel_mobile ?? $candidate->phone_number ?? '' }}" required readonly>
                            </div>
                        </div>

                        <!-- Tel. Fax -->
                        <div class="mb-4">
                            <div class="form-group">
                                <label for="tel_fax">Tel. Fax:</label>
                                <input type="text" id="tel_fax" name="tel_fax" value="{{ $personalDetail->tel_fax ?? '' }}">

                            <!-- Email Address -->
                                <label for="email">Email Address:</label>
                                <input type="email" id="email" name="email" value="{{ $personalDetail->email ?? $candidate->email ?? '' }}" required readonly>
                            </div>
                        </div>

                        <!-- Permanent Address -->
                        <div class="mb-4">

                                <h2>Permanent Address</h2>
<hr>
                            <div class="mb-4">
                                <div class="form-group">
                                    <label for="permanent_address_line1">Address Line 1:</label>
                                    <input type="text" id="permanent_address_line1" name="permanent_address_line1" value="{{ $personalDetail->permanent_address_line1 ?? '' }}" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-group">
                                    <label for="permanent_address_line2">Address Line 2:</label>
                                    <input type="text" id="permanent_address_line2" name="permanent_address_line2" value="{{ $personalDetail->permanent_address_line2 ?? '' }}">
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-group">
                                    <label for="permanent_country">Country:</label>
                                        <select id="permanent_country" name="permanent_country" required>
                                            <option value="" disabled selected>Select country</option>
                                        </select>

                                    <label for="permanent_province">Province:</label>
                                    <input type="text" id="permanent_province" name="permanent_province" value="{{ $personalDetail->permanent_province ?? '' }}" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-group">
                                    <label for="permanent_postal_code">Postal Code:</label>
                                    <input type="text" id="permanent_postal_code" name="permanent_postal_code" value="{{ $personalDetail->permanent_postal_code ?? '' }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Postal Address -->
                        <div class="mb-4">
                                <h2>Postal Address</h2>
                           <hr>
                            <div class="mb-4">
                                <div class="form-group">
                                    <label for="postal_address_line1">Address Line 1:</label>
                                    <input type="text" id="postal_address_line1" name="postal_address_line1" value="{{ $personalDetail->postal_address_line1 ?? '' }}" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-group">
                                    <label for="postal_address_line2">Address Line 2:</label>
                                    <input type="text" id="postal_address_line2" name="postal_address_line2" value="{{ $personalDetail->postal_address_line2 ?? '' }}">
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-group">
                                    <label for="postal_country">Country:</label>
                                        <select id="postal_country" name="postal_country" value="{{ $personalDetail->postal_country ?? '' }}" required>
                                            <option value="" disabled selected>Select country</option>
                                        </select>

                                    <label for="postal_province">Province:</label>
                                    <input type="text" id="postal_province" name="postal_province" value="{{ $personalDetail->postal_province ?? '' }}" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-group">
                                    <label for="postal_postal_code">Postal Code:</label>
                                    <input type="text" id="postal_postal_code" name="postal_postal_code" value="{{ $personalDetail->postal_postal_code ?? '' }}" required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Save</button>

                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
        // Array of country names
        const countries = [
            "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Argentina", "Armenia", "Australia", "Austria",
            "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin",
            "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso",
            "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Central African Republic", "Chad", "Chile", "China",
            "Colombia", "Comoros", "Congo (Congo-Brazzaville)", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czechia",
            "Democratic Republic of the Congo", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt",
            "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Fiji", "Finland", "France",
            "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau",
            "Guyana", "Haiti", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel",
            "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea (North)", "Korea (South)",
            "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania",
            "Luxembourg", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania",
            "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique",
            "Myanmar (Burma)", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria",
            "North Macedonia", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru",
            "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia",
            "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal",
            "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia",
            "South Africa", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Sweden", "Switzerland", "Syria",
            "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia",
            "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States",
            "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe"
        ];

        // Populate the country select element for both postal and permanent address
        function populateCountries() {
            const postalCountrySelect = document.getElementById("postal_country");
            const permanentCountrySelect = document.getElementById("permanent_country");

            countries.forEach(country => {
                const postalOption = document.createElement("option");
                postalOption.value = country;
                postalOption.textContent = country;
                if (country === "{{ $personalDetail->postal_country ?? '' }}") {
                    postalOption.selected = true;
                }
                postalCountrySelect.appendChild(postalOption);

                const permanentOption = document.createElement("option");
                permanentOption.value = country;
                permanentOption.textContent = country;
                if (country === "{{ $personalDetail->permanent_country ?? '' }}") {
                    permanentOption.selected = true;
                }
                permanentCountrySelect.appendChild(permanentOption);
            });
        }

        // Call the function to populate the country dropdowns
        populateCountries();

        // Local Storage functionality
        const form = document.querySelector("#personalDetailsForm");

        // Restore saved data when the page loads
        const savedData = JSON.parse(localStorage.getItem("personalDetails"));
        if (savedData) {
            for (const key in savedData) {
                const element = form.elements[key];
                if (element) {
                    if (element.type === "select-one" || element.type === "select-multiple") {
                        element.value = savedData[key];
                    } else if (element.type === "radio" || element.type === "checkbox") {
                        element.checked = savedData[key];
                    } else {
                        element.value = savedData[key];
                    }
                }
            }
        }

        // Save data to localStorage whenever the user types
        form.addEventListener("input", () => {
            const formData = {};
            Array.from(form.elements).forEach((element) => {
                if (element.name) {
                    if (element.type === "radio" || element.type === "checkbox") {
                        formData[element.name] = element.checked;
                    } else {
                        formData[element.name] = element.value;
                    }
                }
            });
            localStorage.setItem("personalDetails", JSON.stringify(formData));
        });

        // Clear localStorage when the "Clear Data" button is clicked
        document.querySelector("#clearData").addEventListener("click", () => {
            localStorage.removeItem("personalDetails");
            form.reset(); // Reset form fields
            alert("Form data cleared!");
        });
    });
                        </script>
                    </form>
                </div>
        </div>
    </section>
</body>

</html>

@include('components.candidate.footer')
