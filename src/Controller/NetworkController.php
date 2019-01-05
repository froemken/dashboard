<?php

namespace App\Controller;

use App\Entity\Host;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NetworkController extends AbstractController
{
    /**
     * @Route("/dns/mx", name="mxLookup")
     *
     * @param Request $request
     * @return Response
     */
    public function mxLookupAction(Request $request)
    {
        $hostname = '';
        $mxHosts = [];
        $mxWeight = [];

        $form = $this->createFormBuilder(new Host())
            ->add('hostname', TextType::class, [
                'attr' => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('lookup', SubmitType::class, [
                'label' => 'Lookup'
            ])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $hostname = $form->getData()->getHostname();
            getmxrr($hostname, $mxHosts, $mxWeight);
        }

        return $this->render('Network/mxLookup.html.twig', [
            'form' => $form->createView(),
            'hostname' => $hostname,
            'mxHosts' => $mxHosts,
            'mxWeight' => $mxWeight
        ]);
    }

    /**
     * @Route("/dns/ns", name="nsLookup")
     *
     * @param Request $request
     * @return Response
     */
    public function nsLookupAction(Request $request)
    {
        $hostname = '';
        $dnsEntries = [];
        $dnsAuth = [];
        $dnsTl = [];
        $dnsTxt = [];

        $form = $this->createFormBuilder(new Host())
            ->add('hostname', TextType::class, [
                'attr' => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('lookup', SubmitType::class, [
                'label' => 'Lookup'
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hostname = $form->getData()->getHostname();
            $dnsAuth = $dnsTl = [];
            $dnsEntries = dns_get_record($hostname, DNS_ANY, $dnsAuth, $dnsTl);
            foreach ($dnsEntries as $key => $dnsEntry) {
                $type[$key] = $dnsEntry['type'];
            }

            array_multisort($type, SORT_ASC, $dnsEntries);
            $dnsTxt = dns_get_record($hostname, DNS_TXT);
        }

        return $this->render('Network/nsLookup.html.twig', [
            'form' => $form->createView(),
            'hostname' => $hostname,
            'dnsEntries' => $dnsEntries,
            'dnsAuth' => $dnsAuth,
            'dnsTl' => $dnsTl,
            'dnsTxt' => $dnsTxt
        ]);
    }

    /**
     * @Route("/dns/ns/{hostname}", name="nsLookupHostname")
     *
     * @param string $hostname
     * @return Response
     */
    public function nsLookupHostnameAction($hostname = '')
    {
        $dnsAuth = $dnsTl = array();
        $dnsEntries = dns_get_record($hostname, DNS_ANY, $dnsAuth, $dnsTl);
        foreach ($dnsEntries as $key => $dnsEntry) {
            $type[$key]    = $dnsEntry['type'];
        }

        array_multisort($type, SORT_ASC, $dnsEntries);
        return array(
            'hostname' => $hostname,
            'dnsEntries' => $dnsEntries,
            'dnsAuth' => $dnsAuth,
            'dnsTl' => $dnsTl,
            'dnsTxt' => dns_get_record($hostname, DNS_TXT)
        );
    }

    /**
     * @Route("/dns/port", name="port")
     *
     * @param Request $request
     * @return Response
     */
    public function portAction(Request $request)
    {
        $hostname = '';
        $port = '';
        $message = '';
        $success = false;

        $form = $this->createFormBuilder(new Host())
            ->add('hostname', TextType::class, [
                'attr' => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('port', TextType::class, [
                'attr' => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('lookup', SubmitType::class, [
                'label' => 'Scan port'
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hostname = $form->getData()->getHostname();
            $port = $form->getData()->getPort();
            try {
                $ipAddress = gethostbyname($hostname);
                $fp = @fsockopen($ipAddress, $port, $errno, $errstr, 5);
                if (!$fp) {
                    // PHP-Warning is deactivated
                    $message = 'Der Port ' . $port . ' auf Server: ' .  $hostname. ' ist nicht erreichbar' . CHR(10);
                    $message .= 'Error: ' . $errno . ' - ' . $errstr;
                } else {
                    $success = true;
                    $message = 'Der Port ' . $port . ' auf Server: ' .  $hostname. ' ist offen';
                    fclose($fp);
                }
            } catch (\Exception $e) {
                // If PHP-Warning is activated, fsockopen throws an Exception
                $message = 'Der Port ' . $port . ' auf Server: ' .  $hostname. ' ist nicht erreichbar' . CHR(10);
                $message .= 'Error: ' . $e->getCode() . ' - ' . $e->getMessage();
            }
        }

        return $this->render('Network/port.html.twig', [
            'form' => $form->createView(),
            'hostname' => $hostname,
            'port' => $port,
            'message' => $message,
            'success' => $success
        ]);
    }
}