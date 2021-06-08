<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NetworkController extends Controller
{
    /**
     * Do not use DNA_ANY, as this can be blocked by target firewalls
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function dns(Request $request)
    {
        $domain = (string)$request->post('domain');
        $authNameservers = [];
        $dnsRecords = dns_get_record(
            $domain,
            DNS_A + DNS_CNAME + DNS_MX +  DNS_NS + DNS_SOA + DNS_TXT + DNS_AAAA + DNS_SRV,
            $authNameservers
        );

        return view(
            'network/dns',
            [
                'domain' => $domain,
                'dnsRecords' => $dnsRecords,
                'authNameservers' => $authNameservers
            ]
        );
    }
}
