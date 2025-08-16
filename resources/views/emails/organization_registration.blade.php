<!DOCTYPE html>
<html>
<head>
    <title>New Organization Registration</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .details-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .details-table th, .details-table td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        .details-table th { background-color: #f5f5f5; width: 30%; }
    </style>
</head>
<body>
    <h2>New Organization Registration</h2>
    
    <h3>Organization Details</h3>
    <table class="details-table">
        <tr>
            <th>Organization Name</th>
            <td>{{ $organization->name }}</td>
        </tr>
        <tr>
            <th>Type</th>
            <td>{{ $organization->organization_type }}</td>
        </tr>
        <tr>
            <th>Website</th>
            <td>{{ $organization->website ?? 'Not provided' }}</td>
        </tr>
    </table>

    <h3>Contact Details</h3>
    <table class="details-table">
        <tr>
            <th>Contact Person</th>
            <td>{{ $organization->contact_name }}</td>
        </tr>
        <tr>
            <th>Designation</th>
            <td>{{ $organization->contact_designation }}</td>
        </tr>
        <tr>
            <th>Contact Number</th>
            <td>{{ $organization->contact_number }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $organization->contact_email }}</td>
        </tr>
    </table>

    <h3>Address Details</h3>
    <table class="details-table">
        <tr>
            <th>Address</th>
            <td>{{ $organization->address }}</td>
        </tr>
        <tr>
            <th>Country</th>
            <td>{{ $organization->country }}</td>
        </tr>
        <tr>
            <th>State</th>
            <td>{{ $organization->state }}</td>
        </tr>
        <tr>
            <th>District</th>
            <td>{{ $organization->district }}</td>
        </tr>
        @if($organization->city_village)
        <tr>
            <th>City/Village</th>
            <td>{{ $organization->city_village }}</td>
        </tr>
        @endif
        @if($organization->pincode)
        <tr>
            <th>Pincode</th>
            <td>{{ $organization->pincode }}</td>
        </tr>
        @endif
    </table>

    <h3>Partnership Interest</h3>
    <table class="details-table">
        <tr>
            <th>Area of Collaboration</th>
            <td>{{ $organization->collaboration }}</td>
        </tr>
        <tr>
            <th>Target Beneficiary</th>
            <td>{{ $organization->beneficiary }}</td>
        </tr>
    </table>

    <p>Thank you for your registration!</p>
</body>
</html>