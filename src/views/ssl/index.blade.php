@extends('management-interface::template.index')

@section('section_body')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body no-padding">
                    <div class="table-responsive no-margin">
                        <table class="table table-striped no-margin">
                            <thead>
                            <tr>
                                <th>
                                    @include('management-interface::template.interface.icons.ssl')
                                    {{ trans_choice('management-interface::ssl.ssl',1) }}
                                </th>
                                <th>
                                    @include('management-interface::template.interface.icons.hostname')
                                    {{ trans_choice('management-interface::hostname.hostname',2) }}
                                </th>
                                <th>
                                    @include('management-interface::template.interface.icons.expiry')
                                    {{ trans('management-interface::ssl.invalidates_at') }}
                                </th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($certificates as $certificate)
                                <tr>
                                    <td>
                                        <code>{{ $certificate->id }}</code>
                                    </td>
                                    <td>
                                        {{ $certificate->present()->hostnamesSummary }}
                                        @if($certificate->present()->additionalHostnames > 0)
                                        <span class="badge">{{ trans('management-interface::generic.n-more', ['n' => $certificate->present()->additionalHostnames]) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $certificate->present()->expiry }}
                                    </td>
                                    <td class="text-right">
                                        @include('management-interface::template.interface.buttons.view', [
                                            'size' => 'xs',
                                            'href' => route('management-interface@ssl@read', $certificate->present()->urlArguments)
                                        ])
                                        {{--@include('management-interface::template.interface.buttons.update', [
                                            'size' => 'xs',
                                            'href' => route('management-interface@ssl@update', $certificate->present()->urlArguments)
                                        ])--}}
                                        @include('management-interface::template.interface.buttons.delete', [
                                            'size' => 'xs',
                                            'href' => route('management-interface@ssl@delete', $certificate->present()->urlArguments)
                                        ])
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3" class="text-center">
                                    {!! $certificates->render() !!}
                                </td>
                                <td class="text-right">
                                    @include('management-interface::template.interface.buttons.add', [
                                        'modal' => '#add-certificate-form'
                                    ])
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('management-interface::ssl.forms.add-certificate')
@endsection