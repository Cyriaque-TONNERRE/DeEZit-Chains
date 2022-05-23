cmake_minimum_required(VERSION 3.22)
project(Solveur C)

set(CMAKE_C_STANDARD 11)

include_directories(.)

add_executable(Solveur
        fonctions.c
        fonctions.h
        solveur.c functions.c functions.h)