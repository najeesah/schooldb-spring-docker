#! /usr/bin/perl
use Digest::SHA qw(hmac_sha256_hex hmac_sha512_hex);

my $otl_hmac_key = 'Zb7xZDtJ4OEHNZ9-Y7IjvPYn4N4'; # Herb
#my $otl_hmac_key = '4J8II3NHrBOOXGWeyo8gn0522bY'; # Sola
my $session_id = "CC4930533";
my $session = "$session_id#POST#/payment_methods";
my $session_hash = hmac_sha256_hex($session, $otl_hmac_key);
print "session_id:   $session_id\n";
print "session_hash: $session_hash\n";

