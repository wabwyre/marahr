@extends("site.app")
@section("title")
    Privacy Policy - {{ $setting->main_name }}
@endsection

@section("content")
    <section id="features">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="container">
                <h2>Privacy Policy</h2>

                <div class="row">
                    <div class="col-md-12">
                        <h4>General</h4>

                        At {{$setting->main_name}}, we respect your need for online privacy and protect any Personal Information that you may share with us, in an appropriate manner. Our practice with respect to use of your Personal Information is as set forth below in this Privacy Policy Statement. As a condition to use of {{$setting->main_name}} Services, you consent to the terms of the Privacy Policy Statement as it may be updated from time to time.

                        <h4>Children's Online Privacy Protection</h4>

                        {{$setting->main_name}} does not knowingly collect Personal Information from users who are under 13 years of age.

                        <h4>Information Recorded and Use:</h4>

                        <h5>Personal Information</h5>

                        During the Registration Process for creating a user account, we request for your name, email address and company name. You will also be asked to choose a password, which will be used solely for the purpose of providing access to your user account. Your name and email address will be used to inform you regarding new services, releases, upcoming events and changes in this Privacy Policy Statement.
                        <br><br/>
                        {{$setting->main_name}} will have access to third party personal information provided by you as part of using {{$setting->main_name}} Services. This information may include third party names, email addresses, phone numbers and physical addresses and will be used for servicing your requirements as expressed by you to {{$setting->main_name}} and solely as part and parcel of your use of {{$setting->main_name}} Services. We do not share this third party personal information with anyone for promotional purposes, nor do we utilize it for any purposes not expressly consented to by you. When you elect to refer friends to the website, we request their email address and name to facilitate the request and deliver a one time email. Your friend may contact us at <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a> to request that we remove this information from our database.
                        <br/><br/>
                        We post user testimonials on our website. These testimonials may include names and other Personal Information and we acquire permission from our users prior to posting these on our website.
                        <br/><br/>
                        {{$setting->main_name}} is not responsible for the Personal Information users elect to post within their testimonials.

                        <h5>Usage Details</h5>

                        Your usage details such as time, frequency, duration and pattern of use, features used and the amount of storage used will be recorded by us in order to enhance your experience of the {{$setting->main_name}} Services and to help us provide you the best possible service.

                        <h5>Contents of your User Account</h5>

                        We store and maintain files, documents, emails and other data stored in your user account at servers provided by cloud services like Microsoft Azure. In order to prevent loss of data due to errors or system failures, we also keep backup copies of data including the contents of your user account. Hence your files and data may remain on our servers even after deletion or termination of your user account. We may retain and use your Personal Information and data as necessary to comply with our legal obligations, resolve disputes, and enforce our rights. We assure you that the contents of your user account will not be disclosed to anyone and will not be accessible even to employees of {{$setting->main_name}} except in circumstances specifically mentioned in this Privacy Policy Statement and Terms of Services. We also do not scan the contents of your user account for serving targeted advertisements.

                        <h5>Payment Information</h5>

                        In case of services requiring payment, we request credit card or other payment account information, which will be used solely for processing payments. Your financial information will not be stored by us except for the name and address of the card holder, the expiry date and the last four digits of the Credit Card number. Subject to your prior consent and where necessary for processing future payments, your financial information will be stored in encrypted form on secure servers of our reputed Payment Gateway Service Provider who is beholden to treating your Personal Information in accordance with this Privacy Policy Statement.

                        <h5>Visitor Details</h5>

                        We use the Internet Protocol address, browser type, browser language, referring URL, files accessed, errors generated, time zone, operating system and other visitor details collected in our log files to analyze the trends, administer the website, track visitor's movements and to improve our website. We link this automatically collected data to other information we collect about you.

                        <h5>Cookies and Other Tracking Technologies</h5>

                        We use temporary and permanent cookies to enhance your experience of our {{$setting->main_name}} Services. If you have turned cookies off, you may not be able to use registered areas of the website. We tie cookie information to your email address when you elect to remain logged in so as to maintain and recall your preferences within the website. Technologies such as: cookies, beacons, tags and scripts are used by {{$setting->main_name}} and our partners [such as reseller partners], affiliates, or service providers [such as analytics service providers]. These technologies are used in analyzing trends, administering the site, tracking users’ movements around the site and to gather demographic information about our user base as a whole. We may receive reports based on the use of these technologies by these companies on an individual as well as aggregated basis.
                        <br/><br/>
                        We use Local Storage Objects (LSOs) such as HTML5 to store content information and preferences. Third parties with whom we partner to provide certain features on our site or to display advertising

                        based upon your Web browsing activity use LSOs such as HTML 5 to collect and store information. Various browsers may offer their own management tools for removing HTML5 LSOs.

                        <h5>Behavioral Targeting/Re-Targeting</h5>

                        We partner with third parties to manage our advertisements on other sites. Our third-party partners may use technologies such as cookies to gather information about your activities on this site and other sites in order to provide you advertising based upon your browsing activities and interests. If you wish to not have this information used for the purpose of serving you interest-based advertisements, you may opt-out by <a href="http://preferences-mgr.truste.com/" target="_blank">clicking here</a> (or if located in the European Union <a href="http://www.youronlinechoices.eu/" _target="blank">click here</a>). However, you will continue to receive generic advertisements on other websites that display advertisements.

                        <h5>Links from our website</h5>

                        Some pages of our website contain external links. You are advised to verify the privacy practices of such other websites. We are not responsible for the manner of use or misuse of information made available by you at such other websites. We encourage you not to provide Personal Information, without assuring yourselves of the Privacy Policy Statement of other websites.

                        <h5>Federated Authentication</h5>

                        You can log in to our site, if option available, using federated authentication providers such as Facebook Connect. These services will authenticate your identity and provide you the option to share certain Personal Information with us such as your name and email address to pre-populate our sign up form.

                        <h5>With whom we share Information</h5>

                        We may need to share your Personal Information and your data to our affiliates, resellers, service providers and business partners solely for the purpose of providing {{$setting->main_name}} Services to you. The purposes for which we may disclose your Personal Information or data to our service providers may include, but are not limited to, data storage, database management, web analytics and payment processing. These service providers are authorized to use your Personal Information or data only as necessary to provide these services to us. In such cases {{$setting->main_name}} will also ensure that such affiliates, resellers, service providers and business partners comply with this Privacy Policy Statement and adopt appropriate confidentiality and security measures. We will obtain your prior specific consent before we share your Personal Information or data to any person outside {{$setting->main_name}} for any purpose that is not directly connected with providing {{$setting->main_name}} Services to you. We will share your Personal Information with third parties only in the ways that are described in this Privacy Policy Statement. We do not sell your Personal Information to third parties. We may share generic aggregated demographic information not linked to any Personal Information regarding visitors and users with our business partners and advertisers. Please be aware that laws in various jurisdictions in which we operate may obligate us to disclose user information and the contents of your user account to the local law enforcement authorities under a legal process or an enforceable government request. In addition, we may also disclose Personal Information and contents of your user account to law enforcement authorities if such disclosure is determined to be necessary by {{$setting->main_name}} in our sole and absolute discretion for protecting the safety of our users, employees, or the general public. If {{$setting->main_name}} is involved in a merger, acquisition, or sale of all or a portion of its business or assets, you will be notified via email and/or a prominent notice on our website of any change in ownership or uses of your Personal Information, as well as any choices you may have regarding your Personal Information.

                        <h5>How secure is your Information</h5>

                        We adopt industry appropriate data collection, storage and processing practices and security measures, as well as physical security measures to protect against unauthorized access, alteration, disclosure or destruction of your Personal Information, username, password, transaction information and data stored in your user account. Access to your name and email address is restricted to our employees who need to know such information in connection with providing {{$setting->main_name}} Services to you and are bound by confidentiality obligations.

                        <h5>Your Choice in Information Use</h5>

                        In the event we decide to use your Personal Information for any purpose other than as stated in this Privacy Policy Statement, we will offer you an effective way to opt out of the use of your Personal Information for those other purposes. From time to time, we may send emails to you regarding new services, releases and upcoming events. You may opt out of receiving newsletters and other secondary messages from {{$setting->main_name}} by selecting the ‘unsubscribe’ function present in every email we send. However, you will continue to receive essential transactional emails.
                        <br/><br/>
                        Accessing, Updating and Removing Personal Information Users who wish to correct, update or remove any Personal Information including those from a public forum, directory or testimonial on our site may do so either by accessing their user account or by contacting {{$setting->main_name}} Customer Support Services at <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>. Such changes may take up to 48 hours to take effect. We respond to all enquiries within 30 days. Investigation of Illegal Activity We may need to provide access to your Personal Information and the contents of your user account to our employees and service providers for the purpose of investigating any suspected illegal activity or potential violation of the terms and conditions for use of {{$setting->main_name}} Services. However, {{$setting->main_name}} will ensure that such access is in compliance with this Privacy Policy Statement and subject to appropriate confidentiality and security measures.

                        <h5>Enforcement of Privacy Policy</h5>

                        We make every effort, including periodic reviews to ensure that Personal Information provided by you is used in conformity with this Privacy Policy Statement. If you have any concerns regarding our adherence to this Privacy Policy Statement or the manner in which Personal Information is used for the purpose of providing {{$setting->main_name}} Services, kindly contact {{$setting->main_name}} Customer Support Services at <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>. We will contact you to address your concerns and we will also co-operate with regulatory authorities in this regard if needed.

                        <h5>Notification of Changes</h5>

                        We may modify the Privacy Policy Statement upon notice to you at any time through a service announcement or by sending email to your primary email address. If we make significant changes in the Privacy Policy Statement that affect your rights, You will be provided with at least 30 days advance notice of the changes by email to your primary email address. You may terminate your use of {{$setting->main_name}} Services by providing {{$setting->main_name}} notice by email within 30 days of being notified of the availability of the modified Privacy Policy Statement if the Privacy Policy Statement is modified in a manner that substantially affects your rights in connection with use of {{$setting->main_name}} Services. Your continued use of {{$setting->main_name}} Services after the effective date of any change to the Privacy Policy Statement will be deemed to be your agreement to the modified Privacy Policy Statement. You will not receive email notification of minor changes to the Privacy Policy Statement. If you are concerned about how your Personal Information is used, you should check back at our privacy policy periodically.

                        <h5>Blogs and Forums</h5>

                        We provide the capacity for users to post information in blogs and forums for sharing information in a public space on the website. This information is publicly available to all users of these forums and visitors to our website. We require registration to publish information, but given the public nature of both platforms, any Personal Information disclosed within these forums may be used to contact users with unsolicited messages. We encourage users to be cautious in disclosure of Personal Information in public forums as {{$setting->main_name}} is not responsible for the Personal Information users elect to disclose.
                        <br/><br/>
                        {{$setting->main_name}} also supports third party widgets such as Facebook and Twitter buttons on the website that allow users to share articles and other information on different platforms. These widgets may collect your IP address, which page you are visiting on our site, and may set a cookie to enable the widgets to function properly. These widgets do not collect or store any Personal Information from users on the website and simply act as a bridge for your convenience in sharing information. Your interactions with these widgets are governed by the privacy policy of the company providing it.

                        <h5>END OF PRIVACY POLICY</h5>

                        If you have any questions or concerns regarding this Privacy Policy Statement, please contact us at <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>. We shall respond to all inquiries within 30 days of receipt upon ascertaining your identity.
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    </section>
@endsection
