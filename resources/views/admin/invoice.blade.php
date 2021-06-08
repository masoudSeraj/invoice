@extends('admin.main')

@section('content')
<section>
    <a href="{{  route('invoice.create')   }}">create new invoice</a>
    <div class="d-flex justify-content-between">
        <div class="d-flex box box-border">
            <h3>name:</h3>
            <p>email:</p>
            <p>city:</p>
            <p>contry:</p>
            <p>phone:</p>
        </div>
        <div class="d-flex box box-border">
            <h3>name:</h3>
            <p>email:</p>
            <p>city:</p>
            <p>contry:</p>
        </div>
    </div>

    <div class="hr-line"></div>

    <div>
        <div class="box box-border my-1">
            <p>Number</p>
        </div>
        <div class="box box-border my-1">
            <p>Date</p>
        </div>
        <div class="box box-border my-1">
            <p>Terms</p>
        </div>
        <div class="box box-border my-1">
            <p>Due</p>
        </div>
    </div>

    <div>
        <table>
            <thead>
                <tr>
                    <th>ss</th>
                    <th>ss</th>
                    <th>ss</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        aa
                        <br>
                        <span class="text-muted">muted text</span>
                    </td>
                    <td>aa
                        <br>
                        <span class="text-muted">muted text</span>
                    </td>

                    <td>aa
                        <br>
                        <span class="text-muted">muted text</span>
                    </td>

                </tr>
                <tr>
                    <td>bb</td>
                    <td>bb</td>
                    <td>bb</td>
                </tr>
                <tr>
                    <td>cc</td>
                    <td>cc</td>
                    <td>cc</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="hr-line"></div>

    <div class="d-flex box justify-content-end" style="margin-left: auto">
        <div> <p>subtotal:</p> </div>
        <div> <p>tax:</p> </div>
        <div> <p>total</p> </div>
        <div> <h3>balance:</h3> </div>
    </div>




</section>
@endsection
