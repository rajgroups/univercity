<!DOCTYPE html>
<html>
<head>
    <title>Student Registration Details</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .details-table { width: 100%; border-collapse: collapse; }
        .details-table th, .details-table td { padding: 8px; border: 1px solid #ddd; }
        .details-table th { background-color: #f2f2f2; text-align: left; }
    </style>
</head>
<body>
    <h2>Student Registration Details</h2>
    
    <table class="details-table">
        <tr>
            <th>Student Name</th>
            <td>{{ $data['student_name'] }}</td>
        </tr>
        <tr>
            <th>Father's Name</th>
            <td>{{ $data['father_name'] ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Mother's Name</th>
            <td>{{ $data['mother_name'] ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Gender</th>
            <td>{{ $data['gender'] }}</td>
        </tr>
        @isset($data['dob'])
        <tr>
            <th>Date of Birth</th>
            <td>{{ \Carbon\Carbon::parse($data['dob'])->format('d M Y') }}</td>
        </tr>
        @endisset
        <!-- Include all other fields similarly -->
    </table>

    <p>Thank you for registering with us!</p>
</body>
</html>