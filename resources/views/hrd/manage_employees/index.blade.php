@include('components.private.header')
@include('components.private.sidebar')

@section('content')
<section class="home-section bg-lightblue">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text text-black">Welcome, Mr/Mrs {{ Auth::user()->username }}!</span>
    </div>


        <div class="container">
            <h1>Manage Employees</h1>
            <p>View and manage all employee data and Key Performance Indicators (KPIs). (ini tarik dari SPDO)</p>

            <form class="d-flex">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>

            <!-- Employees Table -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>KPI</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                        <td>{{ $employee->position }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone_number }}</td>
                        <td>{{ $employee->kpi }}</td> <!-- Update field based on your schema -->
                        <td>
                            <a href="#" class="btn btn-info btn-sm">View</a>
                            <a href="#" class="btn btn-warning btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</section>

<style>
    .home-section {
        background-color: #d2d2d2;
        padding: 20px;
    }

    .home-content {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.5rem;
        color: #333;
    }

    .d-flex{
        float: right;
        display: inline-block;
    }

    .container {
        margin-top: 20px;
        padding: 20px;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1, h3, h4 {
        color: #565656;
    }

    .quick-links ul {
        list-style: none;
        padding-left: 0;
    }

    .quick-links ul li {
        margin: 10px 0;
    }

    .quick-links ul li a {
        color: #007bff;
        text-decoration: none;
    }

    .quick-links ul li a:hover {
        text-decoration: underline;
    }

    .contribution-areas {
        display: flex;
        gap: 20px;
        margin-top: 30px;
    }

    .feature {
        flex: 1;
        background-color: #f9f9f9;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .feature h4 {
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    .feature p {
        font-size: 1rem;
        margin-bottom: 15px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

    @include('components.private.footer')

