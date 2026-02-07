<?php
$response = $this->get('/api/home/certificate');
$response->assertStatus(200);
echo $response->getContent();
