<?php

namespace mailjet;
use \Mailjet\Resources;

require 'mailjet/vendor/autoload.php';


class MailjetTest extends \PHPUnit_Framework_TestCase
{
    private function assertUrl($url, $response)
    {
        $this->assertEquals('https://api.mailjet.com/v3'.$url, $response->request->getUrl());
    }

    public function assertPayload($payload, $response)
    {
        $this->assertEquals($payload, $response->request->getBody());
    }

    public function assertFilters($shouldBe, $response)
    {
        $this->assertEquals($shouldBe, $response->request->getFilters());
    }


    public function testGet()
    {
        $client = new \Mailjet\Client('', '', false);

        $this->assertUrl('/REST/contact', $client->get(Resources::$Contact));

        $this->assertFilters(['id' => 2], $client->get(Resources::$Contact, [
            'filters' => ['id' => 2]
        ]));

        $response = $client->get(Resources::$ContactGetcontactslists, ['id' => 2]);
        $this->assertUrl('/REST/contact/2/getcontactslists', $response);

        // error on sort !
        $response = $client->get(Resources::$Contact, [
            'filters' => ['sort' => 'email+DESC']
        ]);
        $this->assertUrl('/REST/contact', $response);

        $this->assertUrl('/REST/contact/2', $client->get(Resources::$Contact, ['id' => 2]));

        $this->assertUrl(
            '/REST/contact/test@mailjet.com',
            $client->get(Resources::$Contact, ['id' => 'test@mailjet.com'])
        );
    }

    public function testPost()
    {
        $client = new \Mailjet\Client('308f549a732b5fbd97b43f0b0c6f3054', 'e1400ff82ace61bd86a0a57b1998510b');
        $email = [
          'FromName'     => 'Mailjet PHP test',
          'FromEmail'    => 'marcos.junior@uniriotec.br',
          'Text-Part'    => 'Olá, Rita! Este é apenas um teste de envio de e-mail através da API do Mailjet que o seu dedicado e fofo colega Marcos José passou a manhã tentando entender. Se esse e-mail chegou até você, significa que felizmente ele obteve sucesso! Vamos comemorar!',
          'Subject'      => 'PHPunit',
          'Recipients'   => [['Email' => 'rita.menezes.18@gmail.com ']],
          'MJ-custom-ID' => 'Hello ID',
        ];

        $ret = $client->post(Resources::$Email, ['body' => $email]);
        $this->assertUrl('/send', $ret);
        $this->assertPayload($email, $ret);
    }
}
$teste= new MailjetTest();
$teste->testPost();
?>
