#!/bin/bash

name=$1

sudo virsh autostart $name

sudo virsh start $name

sudo virsh snapshot-create $name


