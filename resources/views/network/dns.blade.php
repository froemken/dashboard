@extends('layouts.app')
@section('content')
<h1>Network {{ $domain }}</h1>
<div class="row">
    <div class="col-6">
        <h2>DNS entries</h2>
        @foreach ($dnsRecords as $dnsRecord)
            <div class="card mb-3">
                <div class="card-header">{{ $dnsRecord['type'] }} (TTL: {{ $dnsRecord['ttl'] }})</div>
                <div class="card-body">
                    @switch($dnsRecord['type'])
                        @case('A')
                        {{ $dnsRecord['ip'] }}
                        @break

                        @case('AAAA')
                        {{ $dnsRecord['ipv6'] }}
                        @break

                        @case('HINFO')
                        {{ $dnsRecord['cpu'] }}
                        @break

                        @case('SOA')
                        {{ $dnsRecord['mname'] }}
                        @break

                        @case('SRV')
                        {{ $dnsRecord['pri'] }}
                        @break

                        @case('A6')
                        {{ $dnsRecord['masklen'] }}
                        @break

                        @case('CNAME')
                        @case('MX')
                        @case('NS')
                        @case('PTR')
                        {{ $dnsRecord['target'] }}
                        @break

                        @case('TXT')
                        {{ $dnsRecord['txt'] }}
                        @break
                    @endswitch
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-6">
        <h2>Authoritative Nameservers</h2>
        <div class="card mb-3">
            @if (count($authNameservers))
                @foreach ($authNameservers as $authNameserver)
                    <div class="card-header">Host: {{ $authNameserver['host'] }}</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Property</th>
                                <th>Value</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Class</td>
                                <td>{{ $authNameserver['class'] }}</td>
                            </tr>
                            <tr>
                                <td>Type</td>
                                <td>{{ $authNameserver['type'] }}</td>
                            </tr>
                            <tr>
                                <td>MName</td>
                                <td>{{ $authNameserver['mname'] }}</td>
                            </tr>
                            <tr>
                                <td>RName</td>
                                <td>{{ $authNameserver['rname'] }}</td>
                            </tr>
                            <tr>
                                <td>Serial</td>
                                <td>{{ $authNameserver['serial'] }}</td>
                            </tr>
                            <tr>
                                <td>Refresh</td>
                                <td>{{ $authNameserver['refresh'] }}</td>
                            </tr>
                            <tr>
                                <td>Retry</td>
                                <td>{{ $authNameserver['retry'] }}</td>
                            </tr>
                            <tr>
                                <td>Expire</td>
                                <td>{{ $authNameserver['expire'] }}</td>
                            </tr>
                            <tr>
                                <td>Minimum TTL</td>
                                <td>{{ $authNameserver['minimum-ttl'] }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach
            @else
                <div class="card-header">Host: {{ $domain }}</div>
                <div class="card-body">No authoritative nameservers found</div>
            @endif
        </div>
    </div>
</div>
@endsection
