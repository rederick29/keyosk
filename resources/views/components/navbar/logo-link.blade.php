
{{--
    Logo link component to appear in navbar

    Author(s): Ben Snaith : Main Developer

    TODO: make the size responsive the the width of the window and not just hard-coded
--}}

<a href="/">
    {{-- lg: view --}}
    <svg width="300" height="50" viewBox="0 0 1280 276" fill="none" xmlns="http://www.w3.org/2000/svg" class="hidden md:hidden lg:block">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 73.8037L201.936 0L275.739 201.936L73.8037 275.739L0 73.8037ZM107.523 87.6483V180.739H118.795V150.557L130.432 137.466L162.795 180.739H176.432L137.341 129.648L176.432 87.6483H161.705L119.886 133.83H118.795V87.6483H107.523Z" fill="currentColor"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M200.74 73.8037L402.676 0L476.479 201.936L274.544 275.739L200.74 73.8037ZM312.262 87.6483V180.739H369.171V170.739H323.535V139.103H365.535V129.103H323.535V97.6483H368.444V87.6483H312.262Z" fill="currentColor"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M401.479 73.8037L603.415 0L677.218 201.936L475.283 275.739L401.479 73.8037ZM513.098 87.6483H500.189L533.825 142.375V180.739H545.098V142.375L578.735 87.6483H565.825L540.007 131.103H538.916L513.098 87.6483Z" fill="currentColor"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M602.218 73.8037L804.154 0L877.957 201.936L676.022 275.739L602.218 73.8037ZM776.468 159.648C780.014 152.496 781.786 144.012 781.786 134.193C781.786 124.375 780.014 115.89 776.468 108.739C772.923 101.587 768.059 96.0723 761.877 92.1933C755.696 88.3153 748.635 86.3753 740.696 86.3753C732.756 86.3753 725.696 88.3153 719.514 92.1933C713.332 96.0723 708.468 101.587 704.923 108.739C701.377 115.89 699.605 124.375 699.605 134.193C699.605 144.012 701.377 152.496 704.923 159.648C708.468 166.799 713.332 172.315 719.514 176.193C725.696 180.072 732.756 182.012 740.696 182.012C748.635 182.012 755.696 180.072 761.877 176.193C768.059 172.315 772.923 166.799 776.468 159.648ZM766.832 113.784C769.529 119.33 770.877 126.133 770.877 134.193C770.877 142.254 769.529 149.057 766.832 154.603C764.165 160.148 760.544 164.345 755.968 167.193C751.423 170.042 746.332 171.466 740.696 171.466C735.059 171.466 729.953 170.042 725.377 167.193C720.832 164.345 717.211 160.148 714.514 154.603C711.847 149.057 710.514 142.254 710.514 134.193C710.514 126.133 711.847 119.33 714.514 113.784C717.211 108.239 720.832 104.042 725.377 101.193C729.953 98.3453 735.059 96.9213 740.696 96.9213C746.332 96.9213 751.423 98.3453 755.968 101.193C760.544 104.042 764.165 108.239 766.832 113.784Z" fill="currentColor"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M802.958 73.8037L1004.89 0L1078.7 201.936L876.762 275.739L802.958 73.8037ZM955.691 100.193C959.57 102.739 961.782 106.315 962.327 110.921H973.236C973.085 106.224 971.63 102.027 968.873 98.3303C966.145 94.6333 962.448 91.7243 957.782 89.6033C953.115 87.4513 947.782 86.3753 941.782 86.3753C935.842 86.3753 930.463 87.4663 925.645 89.6483C920.857 91.7993 917.039 94.8303 914.191 98.7393C911.373 102.618 909.963 107.163 909.963 112.375C909.963 118.648 912.085 123.724 916.327 127.603C920.57 131.481 926.327 134.466 933.6 136.557L945.054 139.83C948.327 140.739 951.373 141.799 954.191 143.012C957.009 144.224 959.282 145.799 961.009 147.739C962.736 149.678 963.6 152.193 963.6 155.284C963.6 158.678 962.6 161.648 960.6 164.193C958.6 166.709 955.888 168.678 952.463 170.103C949.039 171.496 945.176 172.193 940.873 172.193C937.176 172.193 933.721 171.648 930.509 170.557C927.327 169.436 924.691 167.739 922.6 165.466C920.539 163.163 919.357 160.254 919.054 156.739H907.418C907.782 161.83 909.342 166.299 912.1 170.148C914.888 173.996 918.706 176.996 923.554 179.148C928.433 181.299 934.206 182.375 940.873 182.375C948.024 182.375 954.1 181.178 959.1 178.784C964.13 176.39 967.948 173.163 970.554 169.103C973.191 165.042 974.509 160.496 974.509 155.466C974.509 151.103 973.615 147.421 971.827 144.421C970.039 141.421 967.766 138.966 965.009 137.057C962.282 135.118 959.418 133.587 956.418 132.466C953.448 131.345 950.751 130.466 948.327 129.83L938.873 127.284C937.145 126.83 935.251 126.239 933.191 125.512C931.13 124.754 929.16 123.799 927.282 122.648C925.403 121.466 923.857 119.996 922.645 118.239C921.463 116.451 920.873 114.315 920.873 111.83C920.873 108.86 921.721 106.209 923.418 103.875C925.145 101.542 927.539 99.7093 930.6 98.3753C933.691 97.0423 937.297 96.3753 941.418 96.3753C947.054 96.3753 951.812 97.6483 955.691 100.193Z" fill="currentColor"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M1003.7 73.8038L1205.64 0.000119359L1279.44 201.936L1077.5 275.739L1003.7 73.8038ZM1111.22 87.6484V180.739H1122.49V150.557L1134.13 137.466L1166.49 180.739H1180.13L1141.04 129.648L1180.13 87.6484H1165.4L1123.58 133.83H1122.49V87.6484H1111.22Z" fill="currentColor"/>
    </svg>
    {{-- md: view --}}
{{--    <svg width="150" height="50" viewBox="0 0 1280 276" fill="none" xmlns="http://www.w3.org/2000/svg" class="hidden md:block lg:hidden">--}}
{{--        <path d="M201.936 4.50015e-05L0 73.8037L73.8037 275.739L275.739 201.936L201.936 4.50015e-05Z" fill="currentColor"/>--}}
{{--        <path d="M107.523 180.739V87.6483H118.795V133.83H119.886L161.705 87.6483H176.432L137.341 129.648L176.432 180.739H162.795L130.432 137.466L118.795 150.557V180.739H107.523Z" fill="black"/>--}}
{{--        <path d="M402.676 5.02394e-05L200.74 73.8037L274.544 275.739L476.479 201.936L402.676 5.02394e-05Z" fill="currentColor"/>--}}
{{--        <path d="M312.262 180.739V87.6483H368.444V97.6483H323.535V129.103H365.535V139.103H323.535V170.739H369.171V180.739H312.262Z" fill="black"/>--}}
{{--        <path d="M603.415 4.50015e-05L401.479 73.8037L475.283 275.739L677.218 201.936L603.415 4.50015e-05Z" fill="currentColor"/>--}}
{{--        <path d="M500.189 87.6483H513.098L538.916 131.103H540.007L565.825 87.6483H578.735L545.098 142.375V180.739H533.825V142.375L500.189 87.6483Z" fill="black"/>--}}
{{--        <path d="M804.154 4.50015e-05L602.218 73.8037L676.022 275.739L877.957 201.936L804.154 4.50015e-05Z" fill="currentColor"/>--}}
{{--        <path d="M781.786 134.193C781.786 144.012 780.014 152.496 776.468 159.648C772.923 166.799 768.059 172.315 761.877 176.193C755.696 180.072 748.635 182.012 740.696 182.012C732.756 182.012 725.696 180.072 719.514 176.193C713.332 172.315 708.468 166.799 704.923 159.648C701.377 152.496 699.605 144.012 699.605 134.193C699.605 124.375 701.377 115.89 704.923 108.739C708.468 101.587 713.332 96.0724 719.514 92.1934C725.696 88.3154 732.756 86.3754 740.696 86.3754C748.635 86.3754 755.696 88.3154 761.877 92.1934C768.059 96.0724 772.923 101.587 776.468 108.739C780.014 115.89 781.786 124.375 781.786 134.193ZM770.877 134.193C770.877 126.133 769.529 119.33 766.832 113.784C764.165 108.239 760.544 104.042 755.968 101.193C751.423 98.3454 746.332 96.9214 740.696 96.9214C735.059 96.9214 729.953 98.3454 725.377 101.193C720.832 104.042 717.211 108.239 714.514 113.784C711.847 119.33 710.514 126.133 710.514 134.193C710.514 142.254 711.847 149.057 714.514 154.603C717.211 160.148 720.832 164.345 725.377 167.193C729.953 170.042 735.059 171.466 740.696 171.466C746.332 171.466 751.423 170.042 755.968 167.193C760.544 164.345 764.165 160.148 766.832 154.603C769.529 149.057 770.877 142.254 770.877 134.193Z" fill="black"/>--}}
{{--        <path d="M1004.89 4.50015e-05L802.958 73.8037L876.762 275.739L1078.7 201.936L1004.89 4.50015e-05Z" fill="currentColor"/>--}}
{{--        <path d="M962.327 110.921C961.782 106.315 959.57 102.739 955.691 100.193C951.812 97.6484 947.054 96.3754 941.418 96.3754C937.297 96.3754 933.691 97.0424 930.6 98.3754C927.539 99.7094 925.145 101.542 923.418 103.875C921.721 106.209 920.873 108.86 920.873 111.83C920.873 114.315 921.463 116.451 922.645 118.239C923.857 119.996 925.403 121.466 927.282 122.648C929.16 123.799 931.13 124.754 933.191 125.512C935.251 126.239 937.145 126.83 938.873 127.284L948.327 129.83C950.751 130.466 953.448 131.345 956.418 132.466C959.418 133.587 962.282 135.118 965.009 137.057C967.766 138.966 970.039 141.421 971.827 144.421C973.615 147.421 974.509 151.103 974.509 155.466C974.509 160.496 973.191 165.042 970.554 169.103C967.948 173.163 964.13 176.39 959.1 178.784C954.1 181.178 948.024 182.375 940.873 182.375C934.206 182.375 928.433 181.299 923.554 179.148C918.706 176.996 914.888 173.996 912.1 170.148C909.342 166.299 907.782 161.83 907.418 156.739H919.054C919.357 160.254 920.539 163.163 922.6 165.466C924.691 167.739 927.327 169.436 930.509 170.557C933.721 171.648 937.176 172.193 940.873 172.193C945.176 172.193 949.039 171.496 952.463 170.103C955.888 168.678 958.6 166.709 960.6 164.193C962.6 161.648 963.6 158.678 963.6 155.284C963.6 152.193 962.736 149.678 961.009 147.739C959.282 145.799 957.009 144.224 954.191 143.012C951.373 141.799 948.327 140.739 945.054 139.83L933.6 136.557C926.327 134.466 920.57 131.481 916.327 127.603C912.085 123.724 909.963 118.648 909.963 112.375C909.963 107.163 911.373 102.618 914.191 98.7394C917.039 94.8304 920.857 91.7994 925.645 89.6484C930.463 87.4664 935.842 86.3754 941.782 86.3754C947.782 86.3754 953.115 87.4514 957.782 89.6034C962.448 91.7244 966.145 94.6334 968.873 98.3304C971.63 102.027 973.085 106.224 973.236 110.921H962.327Z" fill="black"/>--}}
{{--        <path d="M1205.64 6.59532e-05L1003.7 73.8037L1077.5 275.739L1279.44 201.936L1205.64 6.59532e-05Z" fill="currentColor"/>--}}
{{--        <path d="M1111.22 180.739V87.6483H1122.49V133.83H1123.58L1165.4 87.6483H1180.13L1141.04 129.648L1180.13 180.739H1166.49L1134.13 137.466L1122.49 150.557V180.739H1111.22Z" fill="black"/>--}}
{{--    </svg>--}}
    <svg width="50" height="50" viewBox="0 0 276 276" fill="none" xmlns="http://www.w3.org/2000/svg" class="hidden md:block lg:hidden">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 73.8037L201.936 0L275.739 201.936L73.8037 275.739L0 73.8037ZM107.523 87.6483V180.739H118.795V150.557L130.432 137.466L162.795 180.739H176.432L137.341 129.648L176.432 87.6483H161.705L119.886 133.83H118.795V87.6483H107.523Z" fill="currentColor"/>
    </svg>
    {{-- sm: view --}}
    <svg width="40" height="40" viewBox="0 0 276 276" fill="none" xmlns="http://www.w3.org/2000/svg" class="block md:hidden lg:hidden">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 73.8037L201.936 0L275.739 201.936L73.8037 275.739L0 73.8037ZM107.523 87.6483V180.739H118.795V150.557L130.432 137.466L162.795 180.739H176.432L137.341 129.648L176.432 87.6483H161.705L119.886 133.83H118.795V87.6483H107.523Z" fill="currentColor"/>
    </svg>
</a>
